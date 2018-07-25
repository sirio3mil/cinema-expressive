<?php

namespace App\Entity;

/**
 * Peopledetail
 */
class Peopledetail
{
    /**
     * @var string|null
     */
    private $gender;

    /**
     * @var bool
     */
    private $havephoto = '0';

    /**
     * @var \DateTime|null
     */
    private $birthdate;

    /**
     * @var \DateTime|null
     */
    private $deathdate;

    /**
     * @var string|null
     */
    private $birthplace;

    /**
     * @var string|null
     */
    private $deathplace;

    /**
     * @var int|null
     */
    private $height;

    /**
     * @var int
     */
    private $votes = '0';

    /**
     * @var int
     */
    private $score = '0';

    /**
     * @var bool
     */
    private $skip = '0';

    /**
     * @var \DateTime
     */
    private $updatedat = 'getutcdate()';

    /**
     * @var \App\Entity\People
     */
    private $peopleid;

    /**
     * @var \App\Entity\Country
     */
    private $countryid;


    /**
     * Set gender.
     *
     * @param string|null $gender
     *
     * @return Peopledetail
     */
    public function setGender($gender = null)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender.
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set havephoto.
     *
     * @param bool $havephoto
     *
     * @return Peopledetail
     */
    public function setHavephoto($havephoto)
    {
        $this->havephoto = $havephoto;
    
        return $this;
    }

    /**
     * Get havephoto.
     *
     * @return bool
     */
    public function getHavephoto()
    {
        return $this->havephoto;
    }

    /**
     * Set birthdate.
     *
     * @param \DateTime|null $birthdate
     *
     * @return Peopledetail
     */
    public function setBirthdate($birthdate = null)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate.
     *
     * @return \DateTime|null
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set deathdate.
     *
     * @param \DateTime|null $deathdate
     *
     * @return Peopledetail
     */
    public function setDeathdate($deathdate = null)
    {
        $this->deathdate = $deathdate;
    
        return $this;
    }

    /**
     * Get deathdate.
     *
     * @return \DateTime|null
     */
    public function getDeathdate()
    {
        return $this->deathdate;
    }

    /**
     * Set birthplace.
     *
     * @param string|null $birthplace
     *
     * @return Peopledetail
     */
    public function setBirthplace($birthplace = null)
    {
        $this->birthplace = $birthplace;
    
        return $this;
    }

    /**
     * Get birthplace.
     *
     * @return string|null
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set deathplace.
     *
     * @param string|null $deathplace
     *
     * @return Peopledetail
     */
    public function setDeathplace($deathplace = null)
    {
        $this->deathplace = $deathplace;
    
        return $this;
    }

    /**
     * Get deathplace.
     *
     * @return string|null
     */
    public function getDeathplace()
    {
        return $this->deathplace;
    }

    /**
     * Set height.
     *
     * @param int|null $height
     *
     * @return Peopledetail
     */
    public function setHeight($height = null)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height.
     *
     * @return int|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set votes.
     *
     * @param int $votes
     *
     * @return Peopledetail
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    
        return $this;
    }

    /**
     * Get votes.
     *
     * @return int
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set score.
     *
     * @param int $score
     *
     * @return Peopledetail
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set skip.
     *
     * @param bool $skip
     *
     * @return Peopledetail
     */
    public function setSkip($skip)
    {
        $this->skip = $skip;
    
        return $this;
    }

    /**
     * Get skip.
     *
     * @return bool
     */
    public function getSkip()
    {
        return $this->skip;
    }

    /**
     * Set updatedat.
     *
     * @param \DateTime $updatedat
     *
     * @return Peopledetail
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
    
        return $this;
    }

    /**
     * Get updatedat.
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set peopleid.
     *
     * @param \App\Entity\People $peopleid
     *
     * @return Peopledetail
     */
    public function setPeopleid(\App\Entity\People $peopleid)
    {
        $this->peopleid = $peopleid;
    
        return $this;
    }

    /**
     * Get peopleid.
     *
     * @return \App\Entity\People
     */
    public function getPeopleid()
    {
        return $this->peopleid;
    }

    /**
     * Set countryid.
     *
     * @param \App\Entity\Country|null $countryid
     *
     * @return Peopledetail
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
