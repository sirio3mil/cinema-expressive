<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="UserDetail")
 */
class UserDetail implements CinemaEntity
{

    /**
     * @var User
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="access",
     *     nullable=false
     * )
     */
    private $access;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="integer",
     *     name="downloaded",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    private $downloaded;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="integer",
     *     name="viewed",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    private $viewed;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="bigint",
     *     name="ip",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $ip;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="notifications",
     *     nullable=false,
     *     options={"default":1}
     * )
     */
    private $notifications;


    /**
     * @param \DateTime $access
     * @return UserDetail
     */
    public function setAccess(\DateTime $access): UserDetail
    {
        $this->access = $access;
    
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAccess(): \DateTime
    {
        return $this->access;
    }

    /**
     * @param int $downloaded
     * @return UserDetail
     */
    public function setDownloaded(int $downloaded): UserDetail
    {
        $this->downloaded = $downloaded;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getDownloaded(): int
    {
        return $this->downloaded;
    }

    /**
     * @param int $viewed
     * @return UserDetail
     */
    public function setViewed(int $viewed): UserDetail
    {
        $this->viewed = $viewed;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getViewed(): int
    {
        return $this->viewed;
    }

    /**
     * @param int $ip
     * @return UserDetail
     */
    public function setIp(int $ip): UserDetail
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getIp(): int
    {
        return $this->ip;
    }

    /**
     * @param bool $notifications
     * @return UserDetail
     */
    public function setNotifications(bool $notifications): UserDetail
    {
        $this->notifications = $notifications;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getNotifications(): bool
    {
        return $this->notifications;
    }

    /**
     * @param User $user
     * @return UserDetail
     */
    public function setUser(User $user): UserDetail
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
}
