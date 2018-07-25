<?php

namespace App\Entity;

/**
 * Userdetail
 */
class Userdetail
{
    /**
     * @var \DateTime
     */
    private $access;

    /**
     * @var int
     */
    private $downloaded = '0';

    /**
     * @var int
     */
    private $viewed = '0';

    /**
     * @var int
     */
    private $ip;

    /**
     * @var bool
     */
    private $notifications = '1';

    /**
     * @var \App\Entity\User
     */
    private $userid;


    /**
     * Set access.
     *
     * @param \DateTime $access
     *
     * @return Userdetail
     */
    public function setAccess($access)
    {
        $this->access = $access;
    
        return $this;
    }

    /**
     * Get access.
     *
     * @return \DateTime
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set downloaded.
     *
     * @param int $downloaded
     *
     * @return Userdetail
     */
    public function setDownloaded($downloaded)
    {
        $this->downloaded = $downloaded;
    
        return $this;
    }

    /**
     * Get downloaded.
     *
     * @return int
     */
    public function getDownloaded()
    {
        return $this->downloaded;
    }

    /**
     * Set viewed.
     *
     * @param int $viewed
     *
     * @return Userdetail
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
    
        return $this;
    }

    /**
     * Get viewed.
     *
     * @return int
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * Set ip.
     *
     * @param int $ip
     *
     * @return Userdetail
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * Get ip.
     *
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set notifications.
     *
     * @param bool $notifications
     *
     * @return Userdetail
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    
        return $this;
    }

    /**
     * Get notifications.
     *
     * @return bool
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Set userid.
     *
     * @param \App\Entity\User $userid
     *
     * @return Userdetail
     */
    public function setUserid(\App\Entity\User $userid)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid.
     *
     * @return \App\Entity\User
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
