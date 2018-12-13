<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeDefaultValue
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeDefaultValue")
 */
class TapeDefaultValue implements CinemaEntity
{

    use TapeRelated, CountryRelated;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", inversedBy="tapeDefaultValue", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

    /**
     * @var SearchValue
     *
     * @ORM\ManyToOne(targetEntity="SearchValue", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="titleSearchValueId", referencedColumnName="searchValueId")
     */
    private $title;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="castPeopleId", referencedColumnName="peopleId")
     */
    private $cast;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="directorPeopleId", referencedColumnName="peopleId")
     */
    private $director;

    /**
     * @param SearchValue $title
     * @return TapeDefaultValue
     */
    public function setTitle(SearchValue $title): TapeDefaultValue
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * @return SearchValue
     */
    public function getTitle(): SearchValue
    {
        return $this->title;
    }

    /**
     * @param People|null $cast
     * @return TapeDefaultValue
     */
    public function setCast(?People $cast): TapeDefaultValue
    {
        $this->cast = $cast;
    
        return $this;
    }

    /**
     * @return People|null
     */
    public function getCast(): ?People
    {
        return $this->cast;
    }

    /**
     * @param People|null $director
     * @return TapeDefaultValue
     */
    public function setDirector(?People $director): TapeDefaultValue
    {
        $this->director = $director;
    
        return $this;
    }

    /**
     * @return People|null
     */
    public function getDirector(): ?People
    {
        return $this->director;
    }
}
