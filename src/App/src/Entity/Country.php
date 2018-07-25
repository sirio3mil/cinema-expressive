<?php

namespace App\Entity;

/**
 * Country
 */
class Country
{
    /**
     * @var int
     */
    private $countryid;

    /**
     * @var string
     */
    private $officialname;

    /**
     * @var string|null
     */
    private $isocode;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Language
     */
    private $languageid;

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
     * Get countryid.
     *
     * @return int
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Set officialname.
     *
     * @param string $officialname
     *
     * @return Country
     */
    public function setOfficialname($officialname)
    {
        $this->officialname = $officialname;
    
        return $this;
    }

    /**
     * Get officialname.
     *
     * @return string
     */
    public function getOfficialname()
    {
        return $this->officialname;
    }

    /**
     * Set isocode.
     *
     * @param string|null $isocode
     *
     * @return Country
     */
    public function setIsocode($isocode = null)
    {
        $this->isocode = $isocode;
    
        return $this;
    }

    /**
     * Get isocode.
     *
     * @return string|null
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Country
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
     * Set languageid.
     *
     * @param \App\Entity\Language|null $languageid
     *
     * @return Country
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

    /**
     * Add tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Country
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
