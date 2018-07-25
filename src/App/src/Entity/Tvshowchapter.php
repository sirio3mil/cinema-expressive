<?php

namespace App\Entity;

/**
 * Tvshowchapter
 */
class Tvshowchapter
{
    /**
     * @var int|null
     */
    private $season;

    /**
     * @var int|null
     */
    private $chapter;

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;

    /**
     * @var \App\Entity\Tvshow
     */
    private $tvshowtapeid;


    /**
     * Set season.
     *
     * @param int|null $season
     *
     * @return Tvshowchapter
     */
    public function setSeason($season = null)
    {
        $this->season = $season;
    
        return $this;
    }

    /**
     * Get season.
     *
     * @return int|null
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set chapter.
     *
     * @param int|null $chapter
     *
     * @return Tvshowchapter
     */
    public function setChapter($chapter = null)
    {
        $this->chapter = $chapter;
    
        return $this;
    }

    /**
     * Get chapter.
     *
     * @return int|null
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Tvshowchapter
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
     * Set tvshowtapeid.
     *
     * @param \App\Entity\Tvshow|null $tvshowtapeid
     *
     * @return Tvshowchapter
     */
    public function setTvshowtapeid(\App\Entity\Tvshow $tvshowtapeid = null)
    {
        $this->tvshowtapeid = $tvshowtapeid;
    
        return $this;
    }

    /**
     * Get tvshowtapeid.
     *
     * @return \App\Entity\Tvshow|null
     */
    public function getTvshowtapeid()
    {
        return $this->tvshowtapeid;
    }
}
