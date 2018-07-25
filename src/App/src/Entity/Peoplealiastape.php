<?php

namespace App\Entity;

/**
 * Peoplealiastape
 */
class Peoplealiastape
{
    /**
     * @var int
     */
    private $peoplealiastapeid;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Peoplealias
     */
    private $peoplealiasid;

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;


    /**
     * Get peoplealiastapeid.
     *
     * @return int
     */
    public function getPeoplealiastapeid()
    {
        return $this->peoplealiastapeid;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Peoplealiastape
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
     * Set peoplealiasid.
     *
     * @param \App\Entity\Peoplealias|null $peoplealiasid
     *
     * @return Peoplealiastape
     */
    public function setPeoplealiasid(\App\Entity\Peoplealias $peoplealiasid = null)
    {
        $this->peoplealiasid = $peoplealiasid;
    
        return $this;
    }

    /**
     * Get peoplealiasid.
     *
     * @return \App\Entity\Peoplealias|null
     */
    public function getPeoplealiasid()
    {
        return $this->peoplealiasid;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape|null $tapeid
     *
     * @return Peoplealiastape
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
}
