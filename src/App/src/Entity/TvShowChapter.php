<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TvShow
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TvShow")
 */
class TvShowChapter implements CinemaEntity
{

    use CreationDate;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @@var TvShow
     *
     * @ORM\ManyToOne(targetEntity="TvShow", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tvShowTapeId", referencedColumnName="tapeId")
     */
    private $tvShow;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="season",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $season;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="chapter",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $chapter;


    /**
     * @param int|null $season
     * @return TvShowChapter
     */
    public function setSeason(?int $season): TvShowChapter
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSeason(): ?int
    {
        return $this->season;
    }

    /**
     * @param int|null $chapter
     * @return TvShowChapter
     */
    public function setChapter(?int $chapter): TvShowChapter
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * @return int
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param Tape $tape
     * @return TvShowChapter
     */
    public function setTape(Tape $tape): TvShowChapter
    {
        $this->tape = $tape;

        return $this;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }

    /**
     * @param TvShow $tvShow
     * @return TvShowChapter
     */
    public function setTvShow(TvShow $tvShow): TvShowChapter
    {
        $this->tvShow = $tvShow;

        return $this;
    }

    /**
     * @return TvShow
     */
    public function getTvShow(): TvShow
    {
        return $this->tvShow;
    }
}
