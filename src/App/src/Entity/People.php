<?php

namespace App\Entity;

/**
 * People
 */
class People
{
    /**
     * @var int
     */
    private $peopleid;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var string
     */
    private $objectid = 'newid()';


    /**
     * Get peopleid.
     *
     * @return int
     */
    public function getPeopleid()
    {
        return $this->peopleid;
    }

    /**
     * Set fullname.
     *
     * @param string $fullname
     *
     * @return People
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    
        return $this;
    }

    /**
     * Get fullname.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return People
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
     * Set objectid.
     *
     * @param string $objectid
     *
     * @return People
     */
    public function setObjectid($objectid)
    {
        $this->objectid = $objectid;
    
        return $this;
    }

    /**
     * Get objectid.
     *
     * @return string
     */
    public function getObjectid()
    {
        return $this->objectid;
    }
}
