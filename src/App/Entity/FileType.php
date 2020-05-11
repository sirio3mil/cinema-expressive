<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FileType
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="FileType")
 */
class FileType implements CinemaEntity
{

    public const THUMBNAIL = 1;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="smallint",
     *     name="fileTypeId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fileTypeId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="description",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $description;


    /**
     * @return int
     */
    public function getFileTypeId(): int
    {
        return $this->fileTypeId;
    }

    /**
     * @param string $description
     * @return FileType
     */
    public function setDescription(string $description): FileType
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
