<?php

namespace App\Entity;

/**
 * Tvshow
 */
class Tvshow
{
    /**
     * @var bool
     */
    private $finished = '0';

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;


    /**
     * Set finished.
     *
     * @param bool $finished
     *
     * @return Tvshow
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    
        return $this;
    }

    /**
     * Get finished.
     *
     * @return bool
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Tvshow
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
