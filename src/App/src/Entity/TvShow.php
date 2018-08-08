<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TvShow
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TvShow")
 * @ORM\HasLifecycleCallbacks
 */
class TvShow implements CinemaEntity
{

    use CreationDate;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="finished",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $finished;


    /**
     * @param bool $finished
     * @return TvShow
     */
    public function setFinished(bool $finished): TvShow
    {
        $this->finished = $finished;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getFinished(): bool
    {
        return $this->finished;
    }

    /**
     * @param Tape $tape
     * @return TvShow
     */
    public function setTape(Tape $tape): TvShow
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
