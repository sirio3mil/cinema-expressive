<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 15:05
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Image
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="[Image]")
 */
class Image implements CinemaEntity
{
    /**
     * @var File
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="File", inversedBy="image", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="fileId", referencedColumnName="fileId")
     */
    protected $file;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="int",
     *     name="height",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="int",
     *     name="width",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $width;

    /**
     * @param File $file
     * @return Image
     */
    public function setFile(File $file): Image
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param int $height
     * @return Image
     */
    public function setHeight(int $height): Image
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param int $width
     * @return Image
     */
    public function setWidth(int $width): Image
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }
}