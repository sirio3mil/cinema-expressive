<?php

namespace App\Entity;

/**
 * Peoplealias
 */
class Peoplealias
{
    /**
     * @var int
     */
    private $peoplealiasid;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var \App\Entity\People
     */
    private $peopleid;


    /**
     * Get peoplealiasid.
     *
     * @return int
     */
    public function getPeoplealiasid()
    {
        return $this->peoplealiasid;
    }

    /**
     * Set alias.
     *
     * @param string $alias
     *
     * @return Peoplealias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get alias.
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set peopleid.
     *
     * @param \App\Entity\People|null $peopleid
     *
     * @return Peoplealias
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
}
