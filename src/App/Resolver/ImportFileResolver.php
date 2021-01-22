<?php

namespace App\Resolver;

use App\Entity\File;
use App\Entity\FileType;
use App\Entity\GlobalUniqueObject;
use App\Entity\Image;
use App\Entity\RowType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use Imagick;
use ImagickException;
use JetBrains\PhpStorm\Pure;
use Ramsey\Uuid\Uuid;
use function current;
use function dirname;
use function explode;
use function file_get_contents;
use function file_put_contents;
use function getimagesizefromstring;
use function image_type_to_extension;
use function image_type_to_mime_type;
use function implode;
use function is_dir;
use function mkdir;
use function pathinfo;
use function sha1;
use function str_replace;
use function str_split;
use function strtolower;

class ImportFileResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var array
     */
    private array $config;

    /**
     * @var EntityRepository
     */
    private EntityRepository $fileTypeRepository;

    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     * @param array $config
     */
    public function __construct(private EntityManager $entityManager, array $config)
    {
        $this->config = $config['files'] ?? [];
        $this->fileTypeRepository = $this->entityManager->getRepository(FileType::class);
    }

    /**
     * @param GlobalUniqueObject $object
     * @param string $url
     * @param FileType|null $fileType
     * @return GlobalUniqueObject
     * @throws Exception
     */
    protected function execute(GlobalUniqueObject $object, string $url, ?FileType $fileType): GlobalUniqueObject
    {
        if (!$content = file_get_contents($url)) {
            throw new Exception("Impossible retrieve data from {$url}");
        }
        list($width, $height, $type) = getimagesizefromstring($content);
        $rowTypeId = $object->getRowType()->getRowTypeId();

        if (!$fileType) {
            $fileType = $this->fileTypeRepository->find(FileType::ORIGINAL);
        }
        $dirname = $this->getDirname($fileType, $rowTypeId);
        if (!is_dir($dirname)) {
            throw new Exception("Unreachable save path {$dirname}");
        }
        $extension = image_type_to_extension($type, false);
        $filename = $dirname . DIRECTORY_SEPARATOR . $this->getFilename($object, $extension, sha1($content));
        $info = pathinfo($filename);
        if (!$object->haveFilename($info['filename'])) {
            $size = $this->save($info['dirname'], $filename, $content);
            $image = $this->getImage($height, $width);
            $mime = image_type_to_mime_type($type);
            $file = $this->getFile($info, $mime, $image, $fileType, $size);
            $object->addFile($file);
        }
        $this->createThumbnail($filename, $object);


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
    #[Pure] protected function getFilepath(string $uuid): string
    {
        $parts = explode('-', $uuid, 2);
        $pieces = str_split(current($parts), 3);
        return implode(DIRECTORY_SEPARATOR, $pieces) . DIRECTORY_SEPARATOR . $uuid;
    }

    /**
     * @param GlobalUniqueObject $object
     * @param string $extension
     * @param string $name
     * @return string
     */
    protected function getFilename(GlobalUniqueObject $object, string $extension, string $name): string
    {
        $uuid = strtolower(Uuid::uuid5($object->getObjectId()->toString(), $name)->toString());
        return $this->getFilepath($uuid) . '.' . $extension;
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
        $this->checkDir($path);
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

    /**
     * @param $height
     * @param $width
     * @return Image
     */
    protected function getImage($height, $width): Image
    {
        $image = new Image();
        $image->setHeight($height);
        $image->setWidth($width);
        return $image;
    }

    /**
     * @param array $info
     * @param string $mime
     * @param Image $image
     * @param FileType $fileType
     * @param int $size
     * @return File
     */
    protected function getFile(array $info, string $mime, Image $image, FileType $fileType, int $size): File
    {
        $file = new File();
        $file->setExtension($info['extension']);
        $file->setMime($mime);
        $file->setImage($image);
        $file->setFileType($fileType);
        $file->setSize($size);
        $file->setPath($this->getPublicPath($info['dirname']));
        $file->setName($info['filename']);
        return $file;
    }

    /**
     * @param string $path
     * @throws Exception
     */
    protected function checkDir(string $path): void
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                throw new Exception("Save path {$path} can't be created");
            }
        }
    }

    /**
     * @param string $filename
     * @param GlobalUniqueObject $object
     * @throws ImagickException
     * @throws Exception
     */
    protected function createThumbnail(string $filename, GlobalUniqueObject $object): void
    {
        $info = pathinfo($filename);
        $dirname = str_replace(
            $this->config['original'],
            $this->config['thumbnail'],
            dirname($info['dirname'], 3)
        );
        if (!is_dir($dirname)) {
            throw new Exception("Unreachable thumbnail path {$dirname}");
        }
        $thumb = new Imagick($filename);
        $thumb->thumbnailImage(
            $this->config['thumbnail_width'],
            $this->config['thumbnail_height'],
            true
        );
        $filename = $dirname . DIRECTORY_SEPARATOR . $this->getFilename(
                $object,
                $info['extension'],
                sha1($thumb->getImageBlob())
            );
        $info = pathinfo($filename);
        if (!$object->haveFilename($info['filename'])) {
            $this->checkDir($info['dirname']);
            /** @var FileType $fileType */
            $fileType = $this->fileTypeRepository->find(FileType::THUMBNAIL);
            $thumb->writeImage($filename);
            $size = $thumb->getImageLength();
            $image = $this->getImage($thumb->getImageHeight(), $thumb->getImageWidth());
            $file = $this->getFile($info, $thumb->getImageMimeType(), $image, $fileType, $size);
            $object->addFile($file);
        }
        $thumb->destroy();
    }
}
