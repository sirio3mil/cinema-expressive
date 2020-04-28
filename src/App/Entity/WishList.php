<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class WishList
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="usr.WishList")
 */
class WishList implements CinemaEntity
{
    /**
     * @var TapeUserHistory
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="TapeUserHistory", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserHistoryId", referencedColumnName="tapeUserHistoryId")
     */
    private $tapeUserHistory;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY", inversedBy="wishList")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;

    /**
     * @var TapeUser
     *
     * @ORM\ManyToOne(targetEntity="TapeUser", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserId", referencedColumnName="tapeUserId")
     */
    private $tapeUser;

    /**
     * @var TapeUserStatus
     *
     * @ORM\ManyToOne(targetEntity="TapeUserStatus", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserStatusId", referencedColumnName="tapeUserStatusId")
     */
    private $tapeUserStatus;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return WishList
     */
    public function setUser(User $user): WishList
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return TapeUserHistory
     */
    public function getTapeUserHistory(): TapeUserHistory
    {
        return $this->tapeUserHistory;
    }

    /**
     * @param TapeUserHistory $tapeUserHistory
     * @return WishList
     */
    public function setTapeUserHistory(TapeUserHistory $tapeUserHistory): WishList
    {
        $this->tapeUserHistory = $tapeUserHistory;
        return $this;
    }

    /**
     * @return TapeUser
     */
    public function getTapeUser(): TapeUser
    {
        return $this->tapeUser;
    }

    /**
     * @param TapeUser $tapeUser
     * @return WishList
     */
    public function setTapeUser(TapeUser $tapeUser): WishList
    {
        $this->tapeUser = $tapeUser;
        return $this;
    }

    /**
     * @return TapeUserStatus
     */
    public function getTapeUserStatus(): TapeUserStatus
    {
        return $this->tapeUserStatus;
    }

    /**
     * @param TapeUserStatus $tapeUserStatus
     * @return WishList
     */
    public function setTapeUserStatus(TapeUserStatus $tapeUserStatus): WishList
    {
        $this->tapeUserStatus = $tapeUserStatus;
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
     * @param Tape $tape
     * @return WishList
     */
    public function setTape(Tape $tape): WishList
    {
        $this->tape = $tape;
        return $this;
    }
}
