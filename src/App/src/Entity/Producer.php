<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Producer
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Producer")
 */
class Producer implements CinemaEntity
{

    use TapeCollection;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="integer",
     *     name="producerId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $producerId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="name",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $name;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    private $country;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="producers", fetch="EXTRA_LAZY")
     */
    protected $tapes;

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
    public function getProducerId(): int
    {
        return $this->producerId;
    }

    /**
     * @param string $name
     * @return Producer
     */
    public function setName(string $name): Producer
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
     * @param Country|null $country
     * @return Producer
     */
    public function setCountry(Country $country = null): Producer
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }
}
