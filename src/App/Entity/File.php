<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 14:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class File
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="[File]")
 * @ORM\HasLifecycleCallbacks
 */
class File implements CinemaEntity
{
    use CreationDate, ObjectRelated, SoftDeleteable;

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
    private int $fileId;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\ManyToOne(targetEntity="GlobalUniqueObject", inversedBy="files", cascade={"all"})
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected GlobalUniqueObject $object;

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
    private string $path;

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
    private string $name;

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
    private string $extension;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="bigint",
     *     name="size",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private int $size;

    /**
     * @var FileType
     *
     * @ORM\ManyToOne(targetEntity="FileType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="fileTypeId", referencedColumnName="fileTypeId")
     */
    private FileType $fileType;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Image", mappedBy="file", cascade={"persist", "remove"})
     */
    protected Image $image;

    /**
     * @var FileSeason
     *
     * @ORM\OneToOne(targetEntity="FileSeason", mappedBy="file", cascade={"persist", "remove"})
     */
    protected FileSeason $season;

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
    private string $mime;

    /**
     * @param FileSeason $season
     * @return File
     */
    public function setSeason(FileSeason $season): File
    {
        $this->season = $season->setFile($this);
        return $this;
    }

    /**
     * @return FileSeason
     */
    public function getSeason(): FileSeason
    {
        return $this->season;
    }

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
}
