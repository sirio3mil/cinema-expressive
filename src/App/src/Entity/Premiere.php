<?php

namespace App\Entity;

/**
 * Premiere
 */
class Premiere
{
    /**
     * @var int
     */
    private $premiereid;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $place = 'Movie';

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\Country
     */
    private $countryid;


    /**
     * Get premiereid.
     *
     * @return int
     */
    public function getPremiereid()
    {
        return $this->premiereid;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Premiere
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set place.
     *
     * @param string $place
     *
     * @return Premiere
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
     * Set tapeid.
     *
     * @param \App\Entity\Tape|null $tapeid
     *
     * @return Premiere
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
     * Set countryid.
     *
     * @param \App\Entity\Country|null $countryid
     *
     * @return Premiere
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
}
