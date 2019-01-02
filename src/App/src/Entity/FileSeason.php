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
 * Class FileSeason
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="FileSeason")
 */
class FileSeason implements CinemaEntity
{
    /**
     * @var File
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="File", inversedBy="season", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="fileId", referencedColumnName="fileId")
     */
    protected $file;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="season",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $season;

    /**
     * @param File $file
     * @return FileSeason
     */
    public function setFile(File $file): FileSeason
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
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @param int $season
     * @return FileSeason
     */
    public function setSeason(int $season): FileSeason
    {
        $this->season = $season;
        return $this;
    }
}