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
    protected $tape;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="year",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="duration",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=20,
     *     name="color",
     *     nullable=true,
     *     options={"fixed":false,"default":"Color"}
     * )
     */
    private $color;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="haveCover",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $haveCover;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="isTvShow",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $isTvShow;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="isTvShowChapter",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $isTvShowChapter;

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
    private $adult;

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
    private $budget;

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
    private $currency;


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
     * @param bool $haveCover
     * @return TapeDetail
     */
    public function setHaveCover(bool $haveCover): TapeDetail
    {
        $this->haveCover = $haveCover;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasCover(): bool
    {
        return $this->haveCover ?? false;
    }

    /**
     * @param bool $isTvShow
     * @return TapeDetail
     */
    public function setIsTvShow(bool $isTvShow): TapeDetail
    {
        $this->isTvShow = $isTvShow;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTvShow(): bool
    {
        return $this->isTvShow ?? false;
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

    /** @ORM\PrePersist */
    public function generateDefaultValues()
    {
        if (is_null($this->currency)) {
            $this->currency = 1;
        }
        if (is_null($this->haveCover)) {
            $this->haveCover = false;
        }
        if (is_null($this->isTvShow)) {
            $this->isTvShow = false;
        }
        if (is_null($this->adult)) {
            $this->adult = false;
        }
        if (is_null($this->budget)) {
            $this->budget = 0;
        }
    }

    /**
     * @return bool
     */
    public function isTvShowChapter(): bool
    {
        return $this->isTvShowChapter ?? false;
    }

    /**
     * @param bool $isTvShowChapter
     * @return TapeDetail
     */
    public function setIsTvShowChapter(bool $isTvShowChapter): TapeDetail
    {
        $this->isTvShowChapter = $isTvShowChapter;

        return $this;
    }
}
