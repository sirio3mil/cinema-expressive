<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Premiere
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Premiere")
 */
class Premiere implements CinemaEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="integer",
     *     name="premiereId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $premiereId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="date",
     *     name="date",
     *     nullable=false
     * )
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=10,
     *     name="place",
     *     nullable=false,
     *     options={"fixed":false,"default":"Movie"}
     * )
     */
    private $place = "Movie";

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    private $country;


    /**
     * @return int
     */
    public function getPremiereId(): int
    {
        return $this->premiereId;
    }

    /**
     * @param \DateTime $date
     * @return Premiere
     */
    public function setDate(\DateTime $date): Premiere
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param string $place
     * @return Premiere
     */
    public function setPlace(string $place): Premiere
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param Tape $tape
     * @return Premiere
     */
    public function setTape(Tape $tape): Premiere
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

    /**
     * @param Country $country
     * @return Premiere
     */
    public function setCountry(Country $country): Premiere
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }
}
