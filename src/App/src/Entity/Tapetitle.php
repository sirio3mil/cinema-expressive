<?php

namespace App\Entity;

/**
 * Tapetitle
 */
class Tapetitle
{
    /**
     * @var int
     */
    private $tapetitleid;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $observations;

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\Country
     */
    private $countryid;

    /**
     * @var \App\Entity\Language
     */
    private $languageid;


    /**
     * Get tapetitleid.
     *
     * @return int
     */
    public function getTapetitleid()
    {
        return $this->tapetitleid;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Tapetitle
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set observations.
     *
     * @param string|null $observations
     *
     * @return Tapetitle
     */
    public function setObservations($observations = null)
    {
        $this->observations = $observations;
    
        return $this;
    }

    /**
     * Get observations.
     *
     * @return string|null
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape|null $tapeid
     *
     * @return Tapetitle
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
     * @return Tapetitle
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
     * Set languageid.
     *
     * @param \App\Entity\Language|null $languageid
     *
     * @return Tapetitle
     */
    public function setLanguageid(\App\Entity\Language $languageid = null)
    {
        $this->languageid = $languageid;
    
        return $this;
    }

    /**
     * Get languageid.
     *
     * @return \App\Entity\Language|null
     */
    public function getLanguageid()
    {
        return $this->languageid;
    }
}
