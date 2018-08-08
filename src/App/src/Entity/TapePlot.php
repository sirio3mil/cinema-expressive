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

    use TapeRelatedPrimary;

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
}
