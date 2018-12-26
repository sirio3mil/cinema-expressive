<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Premiere
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Premiere")
 * @ORM\HasLifecycleCallbacks
 */
class Premiere implements CinemaEntity
{

    use TapeRelatedColumn, CountryRelated, CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="premiereId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $premiereId;

    /**
     * @var DateTime
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
    private $place;


    /**
     * @return int
     */
    public function getPremiereId(): int
    {
        return $this->premiereId;
    }

    /**
     * @param DateTime $date
     * @return Premiere
     */
    public function setDate(DateTime $date): Premiere
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
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

    /** @ORM\PrePersist */
    public function generatePlace()
    {
        if(is_null($this->place)) {
            $this->place = "Movie";
        }
    }
}
