<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use GraphQL\Doctrine\Annotation as API;

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

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TvShowChapterSummary", mappedBy="tvShow", fetch="EXTRA_LAZY")
     */
    protected $summaries;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->summaries = new ArrayCollection();
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
        if ($this->createdAt === null) {
            $this->setFinished(false);
        }
    }

    /**
     * @API\Exclude
     *
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
     * @API\Field(type="?TvShowChapter[]")
     *
     * @return Collection
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    /**
     * @API\Field(type="?TvShowChapter[]")
     *
     * @param int $season
     * @return Collection
     */
    public function getChaptersBySeason(int $season): Collection
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("season", $season));
        return $this->getChapters()->matching($criteria);
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

    /**
     * @return TvShowChapter|null
     */
    public function getLastChapter(): ?TvShowChapter
    {
        /** @var TvShowChapter $maxChapter */
        $maxChapter = null;
        /** @var TvShowChapter $item */
        foreach ($this->chapters as $item) {
            if (!$maxChapter ||
                $item->getSeason() > $maxChapter->getSeason() ||
                (
                    $item->getSeason() == $maxChapter->getSeason() &&
                    $item->getChapter() > $maxChapter->getChapter()
                )
            ) {
                $maxChapter = $item;
            }
        }
        return $maxChapter;
    }

    /**
     * @return Collection
     */
    public function getSummaries(): Collection
    {
        return $this->summaries;
    }

    /**
     * @param User $user
     * @return TvShowChapterSummary|null
     */
    public function getSummaryByUser(User $user): ?TvShowChapterSummary
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("user", $user))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getSummaries()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }
}
