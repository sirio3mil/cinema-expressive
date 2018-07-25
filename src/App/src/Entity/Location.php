<?php

namespace App\Entity;

/**
 * Location
 */
class Location
{
    /**
     * @var int
     */
    private $locationid;

    /**
     * @var string
     */
    private $place;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

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
     * Get locationid.
     *
     * @return int
     */
    public function getLocationid()
    {
        return $this->locationid;
    }

    /**
     * Set place.
     *
     * @param string $place
     *
     * @return Location
     */
    public function setPlace($place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place.
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Location
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
     * Add tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Location
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
