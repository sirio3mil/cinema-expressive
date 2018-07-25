<?php

namespace App\Entity;

/**
 * Tapedetail
 */
class Tapedetail
{
    /**
     * @var \DateTime
     */
    private $updatedat = 'getutcdate()';

    /**
     * @var int|null
     */
    private $year;

    /**
     * @var int|null
     */
    private $duration;

    /**
     * @var string|null
     */
    private $color = 'Color';

    /**
     * @var string|null
     */
    private $sound;

    /**
     * @var bool
     */
    private $havecover = '0';

    /**
     * @var bool
     */
    private $tvshow = '0';

    /**
     * @var int
     */
    private $votes = '0';

    /**
     * @var float
     */
    private $score = '0';

    /**
     * @var bool
     */
    private $adult = '0';

    /**
     * @var float
     */
    private $budget = '0';

    /**
     * @var int
     */
    private $currency = '1';

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;


    /**
     * Set updatedat.
     *
     * @param \DateTime $updatedat
     *
     * @return Tapedetail
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
     * Set year.
     *
     * @param int|null $year
     *
     * @return Tapedetail
     */
    public function setYear($year = null)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year.
     *
     * @return int|null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set duration.
     *
     * @param int|null $duration
     *
     * @return Tapedetail
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration.
     *
     * @return int|null
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set color.
     *
     * @param string|null $color
     *
     * @return Tapedetail
     */
    public function setColor($color = null)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color.
     *
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set sound.
     *
     * @param string|null $sound
     *
     * @return Tapedetail
     */
    public function setSound($sound = null)
    {
        $this->sound = $sound;
    
        return $this;
    }

    /**
     * Get sound.
     *
     * @return string|null
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Set havecover.
     *
     * @param bool $havecover
     *
     * @return Tapedetail
     */
    public function setHavecover($havecover)
    {
        $this->havecover = $havecover;
    
        return $this;
    }

    /**
     * Get havecover.
     *
     * @return bool
     */
    public function getHavecover()
    {
        return $this->havecover;
    }

    /**
     * Set tvshow.
     *
     * @param bool $tvshow
     *
     * @return Tapedetail
     */
    public function setTvshow($tvshow)
    {
        $this->tvshow = $tvshow;
    
        return $this;
    }

    /**
     * Get tvshow.
     *
     * @return bool
     */
    public function getTvshow()
    {
        return $this->tvshow;
    }

    /**
     * Set votes.
     *
     * @param int $votes
     *
     * @return Tapedetail
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
     * @param float $score
     *
     * @return Tapedetail
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score.
     *
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set adult.
     *
     * @param bool $adult
     *
     * @return Tapedetail
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;
    
        return $this;
    }

    /**
     * Get adult.
     *
     * @return bool
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * Set budget.
     *
     * @param float $budget
     *
     * @return Tapedetail
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    
        return $this;
    }

    /**
     * Get budget.
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set currency.
     *
     * @param int $currency
     *
     * @return Tapedetail
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency.
     *
     * @return int
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Tapedetail
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
}
