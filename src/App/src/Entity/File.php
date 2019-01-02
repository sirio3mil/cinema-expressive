<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 14:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class File
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="File")
 * @ORM\HasLifecycleCallbacks
 */
class File implements CinemaEntity
{
    use CreationDate, ObjectRelated;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="fileId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fileId;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\ManyToOne(targetEntity="GlobalUniqueObject", inversedBy="files")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="path",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="name",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=5,
     *     name="extension",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $extension;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="int",
     *     name="size",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="originalName",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $originalName;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="downloadName",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $downloadName;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="deleted",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $deleted;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="deletionDate",
     *     nullable=true
     * )
     */
    protected $deletionDate;

    /**
     * @var FileType
     *
     * @ORM\ManyToOne(targetEntity="FileType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="fileTypeId", referencedColumnName="fileTypeId")
     */
    private $fileType;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Image", mappedBy="file")
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="mime",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $mime;

    /**
     * @param string $mime
     * @return File
     */
    public function setMime(string $mime): File
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * @return string
     */
    public function getMime(): string
    {
        return $this->mime;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return File
     */
    public function setImage(Image $image): File
    {
        $this->image = $image->setFile($this);
        return $this;
    }

    /**
     * @return FileType
     */
    public function getFileType(): FileType
    {
        return $this->fileType;
    }

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @return DateTime
     */
    public function getDeletionDate(): DateTime
    {
        return $this->deletionDate;
    }

    /**
     * @return string
     */
    public function getDownloadName(): string
    {
        return $this->downloadName;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return int
     */
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param bool $deleted
     * @return File
     */
    public function setDeleted(bool $deleted): File
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * @param DateTime $deletionDate
     * @return File
     */
    public function setDeletionDate(DateTime $deletionDate): File
    {
        $this->deletionDate = $deletionDate;
        return $this;
    }

    /**
     * @param string $downloadName
     * @return File
     */
    public function setDownloadName(string $downloadName): File
    {
        $this->downloadName = $downloadName;
        return $this;
    }

    /**
     * @param string $extension
     * @return File
     */
    public function setExtension(string $extension): File
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @param string $name
     * @return File
     */
    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $originalName
     * @return File
     */
    public function setOriginalName(string $originalName): File
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @param string $path
     * @return File
     */
    public function setPath(string $path): File
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param int $size
     * @return File
     */
    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param FileType $fileType
     * @return File
     */
    public function setFileType(FileType $fileType): File
    {
        $this->fileType = $fileType;
        return $this;
    }

    /** @ORM\PrePersist */
    public function generateDeleted()
    {
        if(is_null($this->deleted)) {
            $this->deleted = false;
        }
    }
}