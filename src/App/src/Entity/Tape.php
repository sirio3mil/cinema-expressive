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

    use CreationDate;

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
     * @var string
     *
     * @ORM\Column(
     *     type="guid",
     *     name="objectId",
     *     nullable=false,
     *     options={"fixed":false, "default":"newid()"}
     * )
     */
    private $objectId;

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
     */
    private $locationid;

    /**
     * @var Collection
     */
    private $producerid;

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
        $this->locationid = new ArrayCollection();
        $this->producerid = new ArrayCollection();
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
     * @param string $objectId
     * @return Tape
     */
    public function setObjectId(string $objectId): Tape
    {
        $this->objectId = $objectId;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getObjectId(): string
    {
        return $this->objectId;
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
     * Add locationid.
     *
     * @param \App\Entity\Location $locationid
     *
     * @return Tape
     */
    public function addLocationid(\App\Entity\Location $locationid)
    {
        $this->locationid[] = $locationid;
    
        return $this;
    }

    /**
     * Remove locationid.
     *
     * @param \App\Entity\Location $locationid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLocationid(\App\Entity\Location $locationid)
    {
        return $this->locationid->removeElement($locationid);
    }

    /**
     * Get locationid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocationid()
    {
        return $this->locationid;
    }

    /**
     * Add producerid.
     *
     * @param \App\Entity\Producer $producerid
     *
     * @return Tape
     */
    public function addProducerid(\App\Entity\Producer $producerid)
    {
        $this->producerid[] = $producerid;
    
        return $this;
    }

    /**
     * Remove producerid.
     *
     * @param \App\Entity\Producer $producerid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProducerid(\App\Entity\Producer $producerid)
    {
        return $this->producerid->removeElement($producerid);
    }

    /**
     * Get producerid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducerid()
    {
        return $this->producerid;
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
