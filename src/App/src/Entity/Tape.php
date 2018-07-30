<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;

/**
 * Class Tape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tape")
 */
class Tape implements CinemaEntity
{

    use CreationDate, UniqueObject;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="originalTitle",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $originalTitle;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Country", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeCountry",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="countryId", referencedColumnName="countryId")}
     *     )
     */
    private $countries;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeGenre",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="genreId", referencedColumnName="genreId")}
     *     )
     */
    private $genres;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeLanguage",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="languageId", referencedColumnName="languageId")}
     *     )
     */
    private $languages;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Location", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeLocation",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="locationId", referencedColumnName="locationId")}
     *     )
     */
    private $locations;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Producer", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeProducer",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="producerId", referencedColumnName="producerId")}
     *     )
     */
    private $producers;

    /**
     * @var Collection
     */
    private $tagid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countries = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->producers = new ArrayCollection();
        $this->tagid = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getTapeId(): int
    {
        return $this->tapeId;
    }

    /**
     * @param string $originalTitle
     * @return Tape
     */
    public function setOriginalTitle(string $originalTitle): Tape
    {
        $this->originalTitle = $originalTitle;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @param Country $country
     * @return Tape
     */
    public function addCountry(Country $country): Tape
    {
        $this->countries[] = $country;
    
        return $this;
    }

    /**
     * @param Country $country
     * @return bool
     */
    public function removeCountry(Country $country): bool
    {
        return $this->countries->removeElement($country);
    }

    /**
     * @return Collection
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    /**
     * @param Genre $genre
     * @return Tape
     */
    public function addGenre(Genre $genre): Tape
    {
        $this->genres[] = $genre;
    
        return $this;
    }

    /**
     * @param Genre $genre
     * @return bool
     */
    public function removeGenre(Genre $genre): bool
    {
        return $this->genres->removeElement($genre);
    }

    /**
     * @return Collection
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    /**
     * @param Language $language
     * @return Tape
     */
    public function addLanguage(Language $language): Tape
    {
        $this->languages[] = $language;
    
        return $this;
    }

    /**
     * @param Language $language
     * @return bool
     */
    public function removeLanguage(Language $language): bool
    {
        return $this->languages->removeElement($language);
    }

    /**
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @param Location $location
     * @return Tape
     */
    public function addLocation(Location $location): Tape
    {
        $this->locations[] = $location;
    
        return $this;
    }

    /**
     * @param Location $location
     * @return bool
     */
    public function removeLocation(Location $location): bool
    {
        return $this->locations->removeElement($location);
    }

    /**
     * @return Collection
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    /**
     * @param Producer $producer
     * @return Tape
     */
    public function addProducer(Producer $producer): Tape
    {
        $this->producers[] = $producer;
    
        return $this;
    }

    /**
     * @param Producer $producer
     * @return bool
     */
    public function removeProducer(Producer $producer): bool
    {
        return $this->producers->removeElement($producer);
    }

    /**
     * @return Collection
     */
    public function getProducers(): Collection
    {
        return $this->producers;
    }

    /**
     * Add tagid.
     *
     * @param \App\Entity\Tag $tagid
     *
     * @return Tape
     */
    public function addTagid(\App\Entity\Tag $tagid)
    {
        $this->tagid[] = $tagid;
    
        return $this;
    }

    /**
     * Remove tagid.
     *
     * @param \App\Entity\Tag $tagid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTagid(\App\Entity\Tag $tagid)
    {
        return $this->tagid->removeElement($tagid);
    }

    /**
     * Get tagid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTagid()
    {
        return $this->tagid;
    }
}
