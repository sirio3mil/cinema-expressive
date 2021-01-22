<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderedSubscribedTvShows
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="usr.OrderedSubscribedTvShows")
 */
class OrderedSubscribedTvShows implements CinemaEntity
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    protected User $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="TapeUser", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserId", referencedColumnName="tapeUserId")
     */
    protected TapeUser $tapeUser;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="updatedAt",
     *     nullable=false
     * )
     */
    protected DateTime $updatedAt;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return TapeUser
     */
    public function getTapeUser(): TapeUser
    {
        return $this->tapeUser;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
