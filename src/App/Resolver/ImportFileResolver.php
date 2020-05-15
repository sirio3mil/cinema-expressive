<?php

namespace App\Resolver;

use App\Entity\File;
use App\Entity\FileType;
use App\Entity\GlobalUniqueObject;
use App\Entity\Image;
use App\Entity\RowType;
use Doctrine\ORM\EntityManager;
use Exception;
use function current;
use function explode;
use function file_get_contents;
use function file_put_contents;
use function image_type_to_extension;
use function image_type_to_mime_type;
use function implode;
use function is_dir;
use function mkdir;
use function pathinfo;
use function str_split;
use function strtolower;

class ImportFileResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var array
     */
    private array $config;

    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     * @param array $config
     */
    public function __construct(EntityManager $entityManager, array $config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config['files'] ?? [];
    }

    /**
     * @param GlobalUniqueObject $object
     * @param string $url
     * @param FileType|null $fileType
     * @return GlobalUniqueObject
     * @throws Exception
     * @todo check if file exists before creation
     * @todo create thumbnail
     * @todo create filename using file content and object UUID
     */
    protected function execute(GlobalUniqueObject $object, string $url, ?FileType $fileType): GlobalUniqueObject
    {
        if (!$content = file_get_contents($url)) {
            throw new Exception("Impossible retrieve data from {$url}");
        }
        list($width, $height, $type) = getimagesizefromstring($content);
        $rowTypeId = $object->getRowType()->getRowTypeId();
        if (!$fileType) {
            $fileType = $this->entityManager->getRepository(FileType::class)->find(FileType::ORIGINAL);
        }
        $filename = $this->getFilename($fileType, $rowTypeId, $object, $type);
        $info = pathinfo($filename);
        $size = $this->save($info['dirname'], $filename, $content);
        $urlPath = $this->getPublicPath($info['dirname']);

        $image = new Image();
        $image->setHeight($height);
        $image->setWidth($width);

        $file = new File();
        $file->setExtension($info['extension']);
        $file->setMime(image_type_to_mime_type($type));
        $file->setImage($image);
        $file->setFileType($fileType);
        $file->setSize($size);
        $file->setPath($urlPath);
        $file->setName($info['filename']);

        $object->addFile($file);

        $this->entityManager->flush();

        return $object;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function resolve(array $args)
    {
        /** @var GlobalUniqueObject $object */
        $object = $args['globalUniqueObjectId']->getEntity();
        if (isset($args['fileTypeId'])) {
            /** @var FileType $fileType */
            $fileType = $args['fileTypeId']->getEntity();
        }
        return $this->execute($object, $args['url'], $fileType ?? null);
    }

    /**
     * @param $fileType
     * @param int $rowTypeId
     * @return string
     * @throws Exception
     */
    protected function getDirname($fileType, int $rowTypeId): string
    {
        $path = $this->config['project_path'] . $this->config['public_path'];
        if ($fileType->getFileTypeId() !== FileType::SEASON) {
            switch ($rowTypeId) {
                case RowType::ROW_TYPE_PEOPLE:
                    $path .= $this->config['people'];
                    break;
                case RowType::ROW_TYPE_TAPE:
                    $path .= $this->config['tapes'];
                    break;
                default:
                    throw new Exception('Row type not configured to save file');
            }
        } else {
            $path .= $this->config['seasons'];
        }
        $path .= $this->config['original'];

        return $path;
    }

    /**
     * @param string $uuid
     * @return string
     */
    protected function getFilepath(string $uuid): string
    {
        $parts = explode('-', $uuid, 2);
        $pieces = str_split(current($parts), 3);
        return implode(DIRECTORY_SEPARATOR, $pieces) . DIRECTORY_SEPARATOR . $uuid;
    }

    /**
     * @param $fileType
     * @param int $rowTypeId
     * @param GlobalUniqueObject $object
     * @param $type
     * @return string
     * @throws Exception
     */
    protected function getFilename($fileType, int $rowTypeId, GlobalUniqueObject $object, $type): string
    {
        $dirname = $this->getDirname($fileType, $rowTypeId);
        if (!is_dir($dirname)) {
            throw new Exception("Unreachable save path {$dirname}");
        }
        $uuid = strtolower($object->getObjectId()->toString());
        return $dirname . DIRECTORY_SEPARATOR . $this->getFilepath($uuid) . image_type_to_extension($type);
    }

    /**
     * @param string $path
     * @param string $filename
     * @param string $content
     * @return int
     * @throws Exception
     */
    protected function save(string $path, string $filename, string $content): int
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                throw new Exception("Save path {$path} can't be created");
            }
        }
        if (!$size = file_put_contents($filename, $content)) {
            throw new Exception("Error saving file {$filename}");
        }
        return $size;
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getPublicPath(string $path): string
    {
        $basePath = $this->config['project_path'] . DIRECTORY_SEPARATOR . 'public';
        return str_replace($basePath, '', $path);
    }
}
