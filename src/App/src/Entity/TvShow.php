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

    use CreationDate, TapeRelated;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", inversedBy="tvShow", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

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

    /** @ORM\PrePersist */
    public function generateFinishedFlag()
    {
        if(is_null($this->createdAt)) {
            $this->setFinished(false);
        }
    }
}
