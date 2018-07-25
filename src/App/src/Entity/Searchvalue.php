<?php

namespace App\Entity;

/**
 * Searchvalue
 */
class Searchvalue
{
    /**
     * @var int
     */
    private $searchvalueid;

    /**
     * @var string
     */
    private $objectid;

    /**
     * @var string
     */
    private $searchparam;


    /**
     * Get searchvalueid.
     *
     * @return int
     */
    public function getSearchvalueid()
    {
        return $this->searchvalueid;
    }

    /**
     * Set objectid.
     *
     * @param string $objectid
     *
     * @return Searchvalue
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

    /**
     * Set searchparam.
     *
     * @param string $searchparam
     *
     * @return Searchvalue
     */
    public function setSearchparam($searchparam)
    {
        $this->searchparam = $searchparam;
    
        return $this;
    }

    /**
     * Get searchparam.
     *
     * @return string
     */
    public function getSearchparam()
    {
        return $this->searchparam;
    }
}
