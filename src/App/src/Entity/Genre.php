<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;

/**
 * Class Genre
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Genre")
 */
class Genre implements CinemaEntity
{

    use CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="integer",
     *     name="genreId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $genreId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="name",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $name;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="genres", fetch="EXTRA_LAZY")
     */
    private $tapes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tapes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @param string $name
     * @return Genre
     */
    public function setName(string $name): Genre
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Tape $tape
     * @return Genre
     */
    public function addTape(Tape $tape): Genre
    {
        $this->tapes[] = $tape;
    
        return $this;
    }

    /**
     * @param Tape $tape
     * @return bool
     */
    public function removeTape(Tape $tape): bool
    {
        return $this->tapes->removeElement($tape);
    }

    /**
     * @return Collection
     */
    public function getTapes(): Collection
    {
        return $this->tapes;
    }
}
