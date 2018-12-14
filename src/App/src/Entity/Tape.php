<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tape")
 * @ORM\HasLifecycleCallbacks
 */
class Tape implements CinemaEntity
{

    use CreationDate, ObjectRelatedColumn;

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
     * @ORM\ManyToMany(targetEntity="Sound", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeSound",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="soundId", referencedColumnName="soundId")}
     *     )
     */
    private $sounds;

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
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeTag",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tagId", referencedColumnName="tagId")}
     *     )
     */
    private $tags;

    /**
     * @var TapeDefaultValue
     *
     * @ORM\OneToOne(targetEntity="TapeDefaultValue", mappedBy="tape")
     */
    protected $default;

    /**
     * @var TapeDetail
     *
     * @ORM\OneToOne(targetEntity="TapeDetail", mappedBy="tape")
     */
    protected $detail;

    /**
     * @var TapePlot
     *
     * @ORM\OneToOne(targetEntity="TapePlot", mappedBy="tape")
     */
    protected $plot;

    /**
     * @var TvShow
     *
     * @ORM\OneToOne(targetEntity="TvShow", mappedBy="tape")
     */
    protected $tvShow;

    /**
     * @var TvShowChapter
     *
     * @ORM\OneToOne(targetEntity="TvShowChapter", mappedBy="tape")
     */
    protected $tvShowChapter;

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
        $this->tags = new ArrayCollection();
        $this->sounds = new ArrayCollection();
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
     * @param Tag $tag
     * @return Tape
     */
    public function addTag(Tag $tag): Tape
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @param Tag $tag
     * @return bool
     */
    public function removeTag(Tag $tag): bool
    {
        return $this->tags->removeElement($tag);
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Sound $sound
     * @return Tape
     */
    public function addSound(Sound $sound): Tape
    {
        $this->sounds[] = $sound;

        return $this;
    }

    /**
     * @param Sound $sound
     * @return bool
     */
    public function removeSound(Sound $sound): bool
    {
        return $this->sounds->removeElement($sound);
    }

    /**
     * @return Collection
     */
    public function getSounds(): Collection
    {
        return $this->sounds;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->getTapeId());
    }

    /**
     * @param TapeDefaultValue $default
     * @return Tape
     */
    public function setDefault(TapeDefaultValue $default): Tape
    {
        $this->default = $default->setTape($this);
        return $this;
    }

    /**
     * @return TapeDefaultValue
     */
    public function getDefault(): TapeDefaultValue
    {
        return $this->default;
    }

    /**
     * @param TapeDetail $detail
     * @return Tape
     */
    public function setDetail(TapeDetail $detail): Tape
    {
        $this->detail = $detail->setTape($this);
        return $this;
    }

    /**
     * @return TapeDetail
     */
    public function getDetail(): TapeDetail
    {
        return $this->detail;
    }

    /**
     * @param TapePlot $plot
     * @return Tape
     */
    public function setPlot(TapePlot $plot): Tape
    {
        $this->plot = $plot->setTape($this);
        return $this;
    }

    /**
     * @return TapePlot
     */
    public function getPlot(): TapePlot
    {
        return $this->plot;
    }

    /**
     * @param TvShow $tvShow
     * @return Tape
     */
    public function setTvShow(TvShow $tvShow): Tape
    {
        $this->tvShow = $tvShow->setTape($this);
        return $this;
    }

    /**
     * @return TvShow
     */
    public function getTvShow(): TvShow
    {
        return $this->tvShow;
    }


    /**
     * @param TvShowChapter $tvShowChapter
     * @return Tape
     */
    public function setTvShowChapter(TvShowChapter $tvShowChapter): Tape
    {
        $this->tvShowChapter = $tvShowChapter->setTape($this);
        return $this;
    }

    /**
     * @return TvShowChapter
     */
    public function getTvShowChapter(): TvShowChapter
    {
        return $this->tvShowChapter;
    }
}
