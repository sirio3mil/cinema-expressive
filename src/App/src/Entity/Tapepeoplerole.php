<?php

namespace App\Entity;

/**
 * Tapepeoplerole
 */
class Tapepeoplerole
{
    /**
     * @var int
     */
    private $tapepeopleroleid;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\People
     */
    private $peopleid;

    /**
     * @var \App\Entity\Role
     */
    private $roleid;


    /**
     * Get tapepeopleroleid.
     *
     * @return int
     */
    public function getTapepeopleroleid()
    {
        return $this->tapepeopleroleid;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tapepeoplerole
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
     * @return Tapepeoplerole
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
     * Set peopleid.
     *
     * @param \App\Entity\People|null $peopleid
     *
     * @return Tapepeoplerole
     */
    public function setPeopleid(\App\Entity\People $peopleid = null)
    {
        $this->peopleid = $peopleid;
    
        return $this;
    }

    /**
     * Get peopleid.
     *
     * @return \App\Entity\People|null
     */
    public function getPeopleid()
    {
        return $this->peopleid;
    }

    /**
     * Set roleid.
     *
     * @param \App\Entity\Role|null $roleid
     *
     * @return Tapepeoplerole
     */
    public function setRoleid(\App\Entity\Role $roleid = null)
    {
        $this->roleid = $roleid;
    
        return $this;
    }

    /**
     * Get roleid.
     *
     * @return \App\Entity\Role|null
     */
    public function getRoleid()
    {
        return $this->roleid;
    }
}
