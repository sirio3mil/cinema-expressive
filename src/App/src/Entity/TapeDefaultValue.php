<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class TapeDefaultValue
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeDefaultValue")
 */
class TapeDefaultValue implements CinemaEntity
{
    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var SearchValue
     *
     * @ORM\ManyToOne(targetEntity="SearchValue", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="searchValueId", referencedColumnName="searchValueId")
     */
    private $defaultTitle;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="castPeopleId", referencedColumnName="peopleId")
     */
    private $defaultCast;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="directorPeopleId", referencedColumnName="peopleId")
     */
    private $defaultDirector;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    private $defaultCountry;


    /**
     * @param Tape $tape
     * @return TapeDefaultValue
     */
    public function setTape(Tape $tape): TapeDefaultValue
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
     * @param SearchValue $defaultTitle
     * @return TapeDefaultValue
     */
    public function setDefaultTitle(SearchValue $defaultTitle): TapeDefaultValue
    {
        $this->defaultTitle = $defaultTitle;
    
        return $this;
    }

    /**
     * @return SearchValue
     */
    public function getDefaultTitle(): SearchValue
    {
        return $this->defaultTitle;
    }

    /**
     * @param People|null $defaultCast
     * @return TapeDefaultValue
     */
    public function setDefaultCast(?People $defaultCast): TapeDefaultValue
    {
        $this->defaultCast = $defaultCast;
    
        return $this;
    }

    /**
     * @return People|null
     */
    public function getDefaultCast(): ?People
    {
        return $this->defaultCast;
    }

    /**
     * @param People|null $defaultDirector
     * @return TapeDefaultValue
     */
    public function setDefaultDirector(?People $defaultDirector): TapeDefaultValue
    {
        $this->defaultDirector = $defaultDirector;
    
        return $this;
    }

    /**
     * @return People|null
     */
    public function getDefaultDirector(): ?People
    {
        return $this->defaultDirector;
    }

    /**
     * @param Country|null $defaultCountry
     * @return TapeDefaultValue
     */
    public function setDefaultCountry(?Country $defaultCountry): TapeDefaultValue
    {
        $this->defaultCountry = $defaultCountry;
    
        return $this;
    }

    /**
     * @return Country|null
     */
    public function getDefaultCountry(): ?Country
    {
        return $this->defaultCountry;
    }
}
