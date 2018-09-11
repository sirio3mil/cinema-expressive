<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Place
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Place")
 */
class Place implements CinemaEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="smallint",
     *     name="placeId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $placeId;

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
     * @return int
     */
    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    /**
     * @param string $description
     * @return Place
     */
    public function setDescription(string $description): Place
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
