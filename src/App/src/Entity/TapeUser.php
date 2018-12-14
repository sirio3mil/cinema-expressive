<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    use CreationDate, TapeRelatedColumn;
    
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
    private $tapeUserId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;

    /**
     * @var TapeUserScore
     *
     * @ORM\OneToOne(targetEntity="TapeUserScore", mappedBy="tapeUser")
     */
    protected $score;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeUserHistory", mappedBy="tapeUser", cascade={"persist", "remove"})
     */
    protected $history;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->history = new ArrayCollection();
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
     * @return TapeUserScore
     */
    public function getScore(): TapeUserScore
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
        foreach ($history as $item){
            $item->setTapeUser($this);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getHistory(): Collection
    {
        return $this->history;
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
