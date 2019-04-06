<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TvShow
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TvShow")
 * @ORM\HasLifecycleCallbacks
 */
class TvShow implements CinemaEntity
{

    use CreationDate, TapeRelated;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", inversedBy="tvShow", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TvShowChapter", mappedBy="tvShow", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $chapters;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="finished",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    protected $finished;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
    }


    /**
     * @param bool $finished
     * @return TvShow
     */
    public function setFinished(bool $finished): TvShow
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * @return bool
     */
    public function getFinished(): bool
    {
        return $this->finished;
    }

    /** @ORM\PrePersist */
    public function generateFinishedFlag()
    {
        if (is_null($this->createdAt)) {
            $this->setFinished(false);
        }
    }

    /**
     * @param Collection $chapters
     * @return TvShow
     */
    public function setChapters(Collection $chapters): TvShow
    {
        $this->chapters = $chapters;
        /** @var TvShowChapter $item */
        foreach ($chapters as $item) {
            $item->setTvShow($this);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    /**
     * @param TvShowChapter $tvShowChapter
     * @return TvShow
     */
    public function addChapter(TvShowChapter $tvShowChapter): TvShow
    {
        $this->chapters[] = $tvShowChapter->setTvShow($this);
        return $this;
    }

    /**
     * @param TvShowChapter $tvShowChapter
     * @return bool
     */
    public function removeChapter(TvShowChapter $tvShowChapter): bool
    {
        return $this->chapters->removeElement($tvShowChapter);
    }
}
