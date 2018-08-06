<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapePlot
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapePlot")
 */
class TapePlot implements CinemaEntity
{

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=0,
     *     name="plot",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $plot;


    /**
     * @param string $plot
     * @return TapePlot
     */
    public function setPlot(string $plot): TapePlot
    {
        $this->plot = $plot;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getPlot(): string
    {
        return $this->plot;
    }

    /**
     * @param Tape $tape
     * @return TapePlot
     */
    public function setTape(Tape $tape): TapePlot
    {
        $this->tape = $tape;
    
        return $this;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }
}
