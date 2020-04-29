<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUser
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUser")
 * @ORM\HasLifecycleCallbacks
 */
class TapeUser implements CinemaEntity
{

    use CreationDate, TapeRelated;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeUserId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $tapeUserId;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="users", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected Tape $tape;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private User $user;

    /**
     * @var TapeUserScore
     *
     * @ORM\OneToOne(targetEntity="TapeUserScore", mappedBy="tapeUser")
     */
    protected TapeUserScore $score;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeUserHistory", mappedBy="tapeUser", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected Collection $history;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->history = new ArrayCollection();
        $this->user = new User();
        $this->tape = new Tape();
        $this->tapeUserId = 0;
        $this->score = new TapeUserScore();
    }


    /**
     * @return int
     */
    public function getTapeUserId(): int
    {
        return $this->tapeUserId;
    }

    /**
     * @param User $user
     * @return TapeUser
     */
    public function setUser(User $user): TapeUser
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param TapeUserScore $score
     * @return TapeUser
     */
    public function setScore(TapeUserScore $score): TapeUser
    {
        $this->score = $score->setTapeUser($this);
        return $this;
    }

    /**
     * @return TapeUserScore|null
     */
    public function getScore(): ?TapeUserScore
    {
        return $this->score;
    }

    /**
     * @param Collection $history
     * @return TapeUser
     */
    public function setHistory(Collection $history): TapeUser
    {
        $this->history = $history;
        /** @var TapeUserHistory $item */
        foreach ($history as $item) {
            $item->setTapeUser($this);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getHistory(): Collection
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->isNull("deletedAt"));
        return $this->history->matching($criteria);
    }

    /**
     * @param TapeUserStatus $tapeUserStatus
     * @return TapeUserHistory|null
     */
    public function getHistoryByStatus(TapeUserStatus $tapeUserStatus): ?TapeUserHistory
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("tapeUserStatus", $tapeUserStatus))
            ->andWhere(Criteria::expr()->isNull("deletedAt"))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->history->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param TapeUserHistory $history
     * @return TapeUser
     */
    public function addHistory(TapeUserHistory $history): TapeUser
    {
        $this->history[] = $history->setTapeUser($this);
        return $this;
    }

    /**
     * @param TapeUserHistory $history
     * @return bool
     */
    public function removeHistory(TapeUserHistory $history): bool
    {
        return $this->history->removeElement($history);
    }
}
