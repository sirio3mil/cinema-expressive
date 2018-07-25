<?php

namespace App\Entity;

/**
 * Producer
 */
class Producer
{
    /**
     * @var int
     */
    private $producerid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \App\Entity\Country
     */
    private $countryid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tapeid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tapeid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get producerid.
     *
     * @return int
     */
    public function getProducerid()
    {
        return $this->producerid;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Producer
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set countryid.
     *
     * @param \App\Entity\Country|null $countryid
     *
     * @return Producer
     */
    public function setCountryid(\App\Entity\Country $countryid = null)
    {
        $this->countryid = $countryid;
    
        return $this;
    }

    /**
     * Get countryid.
     *
     * @return \App\Entity\Country|null
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Add tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Producer
     */
    public function addTapeid(\App\Entity\Tape $tapeid)
    {
        $this->tapeid[] = $tapeid;
    
        return $this;
    }

    /**
     * Remove tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTapeid(\App\Entity\Tape $tapeid)
    {
        return $this->tapeid->removeElement($tapeid);
    }

    /**
     * Get tapeid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTapeid()
    {
        return $this->tapeid;
    }
}
