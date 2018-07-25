<?php

namespace App\Entity;

/**
 * Tapeuser
 */
class Tapeuser
{
    /**
     * @var int
     */
    private $tapeuserid;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\User
     */
    private $userid;


    /**
     * Get tapeuserid.
     *
     * @return int
     */
    public function getTapeuserid()
    {
        return $this->tapeuserid;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tapeuser
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    
        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape|null $tapeid
     *
     * @return Tapeuser
     */
    public function setTapeid(\App\Entity\Tape $tapeid = null)
    {
        $this->tapeid = $tapeid;
    
        return $this;
    }

    /**
     * Get tapeid.
     *
     * @return \App\Entity\Tape|null
     */
    public function getTapeid()
    {
        return $this->tapeid;
    }

    /**
     * Set userid.
     *
     * @param \App\Entity\User|null $userid
     *
     * @return Tapeuser
     */
    public function setUserid(\App\Entity\User $userid = null)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid.
     *
     * @return \App\Entity\User|null
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
