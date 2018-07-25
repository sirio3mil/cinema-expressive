<?php

namespace App\Entity;

/**
 * Imdbnumber
 */
class Imdbnumber
{
    /**
     * @var string
     */
    private $objectid;

    /**
     * @var int
     */
    private $imdbnumber;

    /**
     * @var \App\Entity\Rowtype
     */
    private $rowtypeid;


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
     * Set imdbnumber.
     *
     * @param int $imdbnumber
     *
     * @return Imdbnumber
     */
    public function setImdbnumber($imdbnumber)
    {
        $this->imdbnumber = $imdbnumber;
    
        return $this;
    }

    /**
     * Get imdbnumber.
     *
     * @return int
     */
    public function getImdbnumber()
    {
        return $this->imdbnumber;
    }

    /**
     * Set rowtypeid.
     *
     * @param \App\Entity\Rowtype|null $rowtypeid
     *
     * @return Imdbnumber
     */
    public function setRowtypeid(\App\Entity\Rowtype $rowtypeid = null)
    {
        $this->rowtypeid = $rowtypeid;
    
        return $this;
    }

    /**
     * Get rowtypeid.
     *
     * @return \App\Entity\Rowtype|null
     */
    public function getRowtypeid()
    {
        return $this->rowtypeid;
    }
}
