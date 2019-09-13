<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Sound
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Sound")
 * @ORM\HasLifecycleCallbacks
 */
class Sound implements CinemaEntity
{

    use CreationDate, TapeCollection;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="integer",
     *     name="soundId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $soundId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="description",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $description;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="sounds", fetch="EXTRA_LAZY")
     */
    protected $tapes;

    public function __construct()
    {
        $this->tapes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getSoundId(): int
    {
        return $this->soundId;
    }

    /**
     * @param string $description
     * @return Sound
     */
    public function setDescription(string $description): Sound
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
