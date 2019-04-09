<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use GraphQL\Doctrine\Annotation as API;
use DateTime;

/**
 * Class Tape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tape")
 * @ORM\HasLifecycleCallbacks
 */
class Tape implements CinemaEntity
{

    use CreationDate, ObjectRelated;

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
     * @var GlobalUniqueObject
     *
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", inversedBy="tape", cascade={"all"})
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

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
     * @ORM\ManyToMany(targetEntity="Location", inversedBy="tapes", fetch="EXTRA_LAZY", cascade={"all"})
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
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="tapes", fetch="EXTRA_LAZY", cascade={"all"})
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
     * @ORM\OneToOne(targetEntity="TapeDetail", mappedBy="tape", cascade={"all"})
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
     * @ORM\OneToOne(targetEntity="TvShow", mappedBy="tape", cascade={"all"})
     */
    protected $tvShow;

    /**
     * @var TvShowChapter
     *
     * @ORM\OneToOne(targetEntity="TvShowChapter", mappedBy="tape")
     */
    protected $tvShowChapter;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeUser", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $users;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapePeopleRole", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $people;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAliasTape", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $aliases;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Premiere", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $premieres;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeTitle", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $titles;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeCertification", mappedBy="tape", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $certifications;

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
        $this->users = new ArrayCollection();
        $this->people = new ArrayCollection();
        $this->aliases = new ArrayCollection();
        $this->premieres = new ArrayCollection();
        $this->titles = new ArrayCollection();
        $this->certifications = new ArrayCollection();
    }

    /**
     * @return int|null
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
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
        }

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
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

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
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
        }

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
     * @API\Field(type="?Language[]")
     *
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
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
        }

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
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
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
        if (!$this->sounds->contains($sound)) {
            $this->sounds[] = $sound;
        }

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
     * @return TapeDetail|null
     */
    public function getDetail(): ?TapeDetail
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
     * @return TapePlot|null
     */
    public function getPlot(): ?TapePlot
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
     * @return TvShow|null
     */
    public function getTvShow(): ?TvShow
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
     * @return TvShowChapter|null
     */
    public function getTvShowChapter(): ?TvShowChapter
    {
        return $this->tvShowChapter;
    }

    /**
     * @param Collection $users
     * @return Tape
     */
    public function setUsers(Collection $users): Tape
    {
        $this->users = $users;
        /** @var TapeUser $item */
        foreach ($users as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param TapeUser $tapeUser
     * @return Tape
     */
    public function addUser(TapeUser $tapeUser): Tape
    {
        $this->users[] = $tapeUser->setTape($this);
        return $this;
    }

    /**
     * @param TapeUser $tapeUser
     * @return bool
     */
    public function removeUser(TapeUser $tapeUser): bool
    {
        return $this->users->removeElement($tapeUser);
    }

    /**
     * @param User $user
     * @return TapeUser|null
     */
    public function getUser(User $user): ?TapeUser
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("user", $user))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getUsers()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param People $people
     * @param Role $role
     * @return TapePeopleRole|null
     */
    public function getTapePeopleRole(People $people, Role $role): ?TapePeopleRole
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("people", $people))
            ->andWhere(Criteria::expr()->eq("role", $role))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getPeople()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param Collection $people
     * @return Tape
     */
    public function setPeople(Collection $people): Tape
    {
        $this->people = $people;
        /** @var TapePeopleRole $item */
        foreach ($people as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?TapePeopleRole[]")
     *
     * @return Collection
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    /**
     * @param TapePeopleRole $tapePeopleRole
     * @return Tape
     */
    public function addPeople(TapePeopleRole $tapePeopleRole): Tape
    {
        $this->people[] = $tapePeopleRole->setTape($this);
        return $this;
    }

    /**
     * @param TapePeopleRole $tapePeopleRole
     * @return bool
     */
    public function removePeople(TapePeopleRole $tapePeopleRole): bool
    {
        return $this->people->removeElement($tapePeopleRole);
    }

    /**
     *
     * @param Collection $aliases
     * @return Tape
     */
    public function setAliases(Collection $aliases): Tape
    {
        $this->aliases = $aliases;
        /** @var PeopleAliasTape $item */
        foreach ($aliases as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?PeopleAliasTape[]")
     *
     * @return Collection
     */
    public function getAliases(): Collection
    {
        return $this->aliases;
    }

    /**
     * @param PeopleAliasTape $peopleAliasTape
     * @return Tape
     */
    public function addPeopleAliasTape(PeopleAliasTape $peopleAliasTape): Tape
    {
        $this->aliases[] = $peopleAliasTape->setTape($this);
        return $this;
    }

    /**
     * @param PeopleAlias $peopleAlias
     * @return Tape
     */
    public function addPeopleAlias(PeopleAlias $peopleAlias): Tape
    {
        return $this->addPeopleAliasTape((new PeopleAliasTape())->setPeopleAlias($peopleAlias));
    }

    /**
     * @param PeopleAliasTape $peopleAliasTape
     * @return bool
     */
    public function removePeopleAliasTape(PeopleAliasTape $peopleAliasTape): bool
    {
        return $this->aliases->removeElement($peopleAliasTape);
    }

    /**
     * @param PeopleAlias $peopleAlias
     * @return PeopleAliasTape|null
     */
    public function getPeopleAliasTape(PeopleAlias $peopleAlias): ?PeopleAliasTape
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("peopleAlias", $peopleAlias))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getAliases()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param Collection $premieres
     * @return Tape
     */
    public function setPremieres(Collection $premieres): Tape
    {
        $this->premieres = $premieres;
        /** @var Premiere $item */
        foreach ($premieres as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?Premiere[]")
     *
     * @return Collection
     */
    public function getPremieres(): Collection
    {
        return $this->premieres;
    }

    /**
     * @param Premiere $premiere
     * @return Tape
     */
    public function addPremiere(Premiere $premiere): Tape
    {
        $this->premieres[] = $premiere->setTape($this);
        return $this;
    }

    /**
     * @param Premiere $premiere
     * @return bool
     */
    public function removePremiere(Premiere $premiere): bool
    {
        return $this->premieres->removeElement($premiere);
    }

    /**
     * @param Country|null $country
     * @param DateTime $date
     * @return Premiere|null
     */
    public function getPremiere(?Country $country, DateTime $date): ?Premiere
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("date", $date))
            ->andWhere(Criteria::expr()->eq("country", $country))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getPremieres()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param Collection $titles
     * @return Tape
     */
    public function setTitles(Collection $titles): Tape
    {
        $this->titles = $titles;
        /** @var TapeTitle $item */
        foreach ($titles as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?TapeTitle[]")
     *
     * @return Collection
     */
    public function getTitles(): Collection
    {
        return $this->titles;
    }

    /**
     * @param TapeTitle $tapeTitle
     * @return Tape
     */
    public function addTitle(TapeTitle $tapeTitle): Tape
    {
        $this->titles[] = $tapeTitle->setTape($this);
        return $this;
    }

    /**
     * @param TapeTitle $tapeTitle
     * @return bool
     */
    public function removeTitle(TapeTitle $tapeTitle): bool
    {
        return $this->titles->removeElement($tapeTitle);
    }

    /**
     * @param Country|null $country
     * @param string $title
     * @return TapeTitle|null
     */
    public function getTitle(?Country $country, string $title): ?TapeTitle
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("title", $title))
            ->andWhere(Criteria::expr()->eq("country", $country))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getTitles()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @param Collection $certifications
     * @return Tape
     */
    public function setCertifications(Collection $certifications): Tape
    {
        $this->certifications = $certifications;
        /** @var TapeCertification $item */
        foreach ($certifications as $item) {
            $item->setTape($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?TapeCertification[]")
     *
     * @return Collection
     */
    public function getCertifications(): Collection
    {
        return $this->certifications;
    }

    /**
     * @param TapeCertification $tapeCertification
     * @return Tape
     */
    public function addCertification(TapeCertification $tapeCertification): Tape
    {
        $this->certifications[] = $tapeCertification->setTape($this);
        return $this;
    }

    /**
     * @param TapeCertification $tapeCertification
     * @return bool
     */
    public function removeCertification(TapeCertification $tapeCertification): bool
    {
        return $this->certifications->removeElement($tapeCertification);
    }

    /**
     * @param Country $country
     * @return TapeCertification|null
     */
    public function getCertification(Country $country): ?TapeCertification
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("country", $country))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getCertifications()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }
}
