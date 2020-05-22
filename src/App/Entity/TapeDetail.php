<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeDetail")
 * @ORM\HasLifecycleCallbacks
 */
class TapeDetail implements CinemaEntity
{

    use CreationDate, Upgradeable, TapeRelated;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", inversedBy="detail", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected Tape $tape;

    /**
     * @var int|null
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="year",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private ?int $year;

    /**
     * @var int|null
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="duration",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private ?int $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     type="string",
     *     length=20,
     *     name="color",
     *     nullable=true,
     *     options={"fixed":false,"default":"Color"}
     * )
     */
    private ?string $color;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="cover",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private bool $cover;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="tvShow",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private bool $tvShow;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="tvShowChapter",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private bool $tvShowChapter;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="adult",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private bool $adult;

    /**
     * @var float
     *
     * @ORM\Column(
     *     type="float",
     *     name="budget",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private float $budget;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="integer",
     *     name="currency",
     *     nullable=false,
     *     options={"unsigned":false,"default":1}
     * )
     */
    private int $currency;

    public function __construct()
    {
        $this->cover = false;
        $this->currency = 1;
        $this->budget = 0;
        $this->adult = false;
        $this->tvShowChapter = false;
        $this->tvShow = false;
        $this->color = null;
        $this->duration = null;
        $this->year = null;
        $this->tape = new Tape();
    }


    /**
     * @param int|null $year
     * @return TapeDetail
     */
    public function setYear(?int $year): TapeDetail
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $duration
     * @return TapeDetail
     */
    public function setDuration(?int $duration): TapeDetail
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param null|string $color
     * @return TapeDetail
     */
    public function setColor(?string $color): TapeDetail
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param bool $cover
     * @return TapeDetail
     */
    public function setCover(bool $cover): TapeDetail
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasCover(): bool
    {
        return $this->cover ?? false;
    }

    /**
     * @param bool $tvShow
     * @return TapeDetail
     */
    public function setTvShow(bool $tvShow): TapeDetail
    {
        $this->tvShow = $tvShow;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTvShow(): bool
    {
        return $this->tvShow ?? false;
    }

    /**
     * @param bool $adult
     * @return TapeDetail
     */
    public function setAdult(bool $adult): TapeDetail
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAdult(): bool
    {
        return $this->adult ?? false;
    }

    /**
     * @param float $budget
     * @return TapeDetail
     */
    public function setBudget(float $budget): TapeDetail
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return float
     */
    public function getBudget(): ?float
    {
        return $this->budget;
    }

    /**
     * @param int $currency
     * @return TapeDetail
     */
    public function setCurrency(int $currency): TapeDetail
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrency(): ?int
    {
        return $this->currency;
    }

    /**
     * @return bool
     */
    public function isTvShowChapter(): bool
    {
        return $this->tvShowChapter ?? false;
    }

    /**
     * @param bool $tvShowChapter
     * @return TapeDetail
     */
    public function setTvShowChapter(bool $tvShowChapter): TapeDetail
    {
        $this->tvShowChapter = $tvShowChapter;

        return $this;
    }
}
