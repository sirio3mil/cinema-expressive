<?php

namespace App\Entity;

/**
 * Tapedefaultvalue
 */
class Tapedefaultvalue
{
    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\Searchvalue
     */
    private $titlesearchvalueid;

    /**
     * @var \App\Entity\People
     */
    private $castpeopleid;

    /**
     * @var \App\Entity\People
     */
    private $directorpeopleid;

    /**
     * @var \App\Entity\Country
     */
    private $countryid;


    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Tapedefaultvalue
     */
    public function setTapeid(\App\Entity\Tape $tapeid)
    {
        $this->tapeid = $tapeid;
    
        return $this;
    }

    /**
     * Get tapeid.
     *
     * @return \App\Entity\Tape
     */
    public function getTapeid()
    {
        return $this->tapeid;
    }

    /**
     * Set titlesearchvalueid.
     *
     * @param \App\Entity\Searchvalue|null $titlesearchvalueid
     *
     * @return Tapedefaultvalue
     */
    public function setTitlesearchvalueid(\App\Entity\Searchvalue $titlesearchvalueid = null)
    {
        $this->titlesearchvalueid = $titlesearchvalueid;
    
        return $this;
    }

    /**
     * Get titlesearchvalueid.
     *
     * @return \App\Entity\Searchvalue|null
     */
    public function getTitlesearchvalueid()
    {
        return $this->titlesearchvalueid;
    }

    /**
     * Set castpeopleid.
     *
     * @param \App\Entity\People|null $castpeopleid
     *
     * @return Tapedefaultvalue
     */
    public function setCastpeopleid(\App\Entity\People $castpeopleid = null)
    {
        $this->castpeopleid = $castpeopleid;
    
        return $this;
    }

    /**
     * Get castpeopleid.
     *
     * @return \App\Entity\People|null
     */
    public function getCastpeopleid()
    {
        return $this->castpeopleid;
    }

    /**
     * Set directorpeopleid.
     *
     * @param \App\Entity\People|null $directorpeopleid
     *
     * @return Tapedefaultvalue
     */
    public function setDirectorpeopleid(\App\Entity\People $directorpeopleid = null)
    {
        $this->directorpeopleid = $directorpeopleid;
    
        return $this;
    }

    /**
     * Get directorpeopleid.
     *
     * @return \App\Entity\People|null
     */
    public function getDirectorpeopleid()
    {
        return $this->directorpeopleid;
    }

    /**
     * Set countryid.
     *
     * @param \App\Entity\Country|null $countryid
     *
     * @return Tapedefaultvalue
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
