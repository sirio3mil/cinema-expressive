<?php

namespace App\Entity;

/**
 * Tapeplot
 */
class Tapeplot
{
    /**
     * @var string
     */
    private $plot;

    /**
     * @var \App\Entity\Tape
     */
    private $tapeid;


    /**
     * Set plot.
     *
     * @param string $plot
     *
     * @return Tapeplot
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;
    
        return $this;
    }

    /**
     * Get plot.
     *
     * @return string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Set tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Tapeplot
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
