<?php

namespace App\Service;

use App\Entity\Ranking;
use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\ImdbNumber;
use App\Entity\GlobalUniqueObject;
use App\Entity\Language;
use App\Entity\Location;
use App\Entity\People;
use App\Entity\PeopleAlias;
use App\Entity\PeopleAliasTape;
use App\Entity\Premiere;
use App\Entity\PremiereDetail;
use App\Entity\Role;
use App\Entity\RowType;
use App\Entity\SearchValue;
use App\Entity\Sound;
use App\Entity\Tag;
use App\Entity\Tape;
use App\Entity\TapeCertification;
use App\Entity\TapeDetail;
use App\Entity\TapePeopleRole;
use App\Entity\TapePeopleRoleCharacter;
use App\Entity\TapeTitle;
use App\Entity\TvShow;
use App\Entity\TvShowChapter;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use ImdbScraper\Iterator\AlsoKnownAsIterator;
use ImdbScraper\Iterator\ReleaseIterator;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Mapper\HomeMapper;
use ImdbScraper\Mapper\KeywordMapper;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Mapper\ReleaseMapper;
use ImdbScraper\Model\AlsoKnownAs;
use ImdbScraper\Model\CastPeople;
use ImdbScraper\Model\Certificate;
use ImdbScraper\Model\Keyword;
use ImdbScraper\Model\Location as Place;
use ImdbScraper\Model\Release;
use ImdbScraper\Model\People as Person;
use Exception;

class ImportImdbMovieService
{
    /** @var RowType */
    protected RowType $peopleRowType;

    /** @var RowType */
    protected RowType $tapeRowType;

    /** @var EntityManager */
    protected EntityManager $entityManager;

    /** @var EntityRepository */
    protected EntityRepository $countryRepository;

    /** @var Tape|null */
    protected ?Tape $tape;

    /** @var int */
    protected int $imdbNumber;

    /**
     * @var SlugGenerator
     */
    private SlugGenerator $generator;

    /**
     * @var People[]
     */
    private array $peopleCreated;

    /**
     * ImportImdbMovieService constructor.
     * @param EntityManager $entityManager
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(EntityManager $entityManager, SlugGenerator $slugGenerator)
    {
        $this->entityManager = $entityManager;
        $this->peopleRowType = $this->getRowType(RowType::ROW_TYPE_PEOPLE);
        $this->tapeRowType = $this->getRowType(RowType::ROW_TYPE_TAPE);
        /** @var EntityRepository $countryRepository */
        $this->countryRepository = $this->entityManager->getRepository(Country::class);
        $this->generator = $slugGenerator;
        $this->peopleCreated = [];
        $this->tape = null;
        $this->imdbNumber = 0;
    }

    /**
     * @param int $imdbNumber
     */
    public function setImdbNumber(int $imdbNumber): void
    {
        $this->imdbNumber = $imdbNumber;
    }

    /**
     * @return int
     */
    public function getImdbNumber(): int
    {
        return $this->imdbNumber;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }

    /**
     * @return RowType
     */
    public function getPeopleRowType(): RowType
    {
        return $this->peopleRowType;
    }

    /**
     * @param RowType $peopleRowType
     * @return ImportImdbMovieService
     */
    public function setPeopleRowType(RowType $peopleRowType): ImportImdbMovieService
    {
        $this->peopleRowType = $peopleRowType;
        return $this;
    }

    /**
     * @param Person $person
     * @return People|null
     * @throws NonUniqueResultException
     */
    protected function getPeopleByImdbNumber(Person $person): ?People
    {
        if (array_key_exists($person->getImdbNumber(), $this->peopleCreated)) {
            return $this->peopleCreated[$person->getImdbNumber()];
        }
        $query = $this->entityManager->createQuery('
            SELECT p 
            FROM App\Entity\People p 
            JOIN App\Entity\ImdbNumber i 
                WITH i.object = p.object 
            WHERE i.imdbNumber = :imdbNumber
        ');
        $query->setParameters([
            'imdbNumber' => $person->getImdbNumber()
        ]);
        $query->useQueryCache(true);
        return $query->getOneOrNullResult();
    }

    /**
     * @param Person $person
     * @return People
     * @throws ORMException
     */
    protected function createPeopleFromPerson(Person $person): People
    {
        $object = new GlobalUniqueObject();
        $object->setRowType($this->getPeopleRowType());
        $this->entityManager->persist($object);
        $people = new People();
        $people->setObject($object);
        $people->setFullName($person->getFullName());
        $this->entityManager->persist($people);
        $imdbNumber = new ImdbNumber();
        $imdbNumber->setImdbNumber($person->getImdbNumber());
        $imdbNumber->setObject($object);
        $this->entityManager->persist($imdbNumber);
        $searchValue = new SearchValue();
        $searchValue->setSearchParam($person->getFullName());
        $searchValue->setSlug($this->generator->generate($person->getFullName()));
        $searchValue->setPrimaryParam(true);
        $people->getObject()->addSearchValue($searchValue);
        $this->peopleCreated[$person->getImdbNumber()] = $people;
        return $people;
    }

    /**
     * @param Person $person
     * @param Role $role
     * @return People
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    protected function addTapePeople(Person $person, Role $role): People
    {
        /** @var People $people */
        if (!$people = $this->getPeopleByImdbNumber($person)) {
            $people = $this->createPeopleFromPerson($person);
        }
        /** @var TapePeopleRole $tapePeopleRole */
        if (!$tapePeopleRole = $this->tape->getTapePeopleRole($people, $role)) {
            $tapePeopleRole = new TapePeopleRole();
            $tapePeopleRole->setRole($role);
            $tapePeopleRole->setPeople($people);
            $this->tape->addPeople($tapePeopleRole);
        }
        if ($person instanceof CastPeople && $person->getCharacter()) {
            /** @var TapePeopleRoleCharacter $peopleAliasTape */
            if (!$tapePeopleRoleCharacter = $tapePeopleRole->getCharacter()) {
                $tapePeopleRoleCharacter = new TapePeopleRoleCharacter();
                $tapePeopleRole->setCharacter($tapePeopleRoleCharacter);
            }
            $tapePeopleRoleCharacter->setCharacter($person->getCharacter());
        }
        return $people;
    }

    /**
     * @throws NonUniqueResultException
     */
    protected function setTape(): void
    {
        try {
            $query = $this->entityManager->createQuery('
                SELECT i 
                FROM App\Entity\ImdbNumber i 
                JOIN i.object o 
                WHERE i.imdbNumber = :imdbNumber 
                    AND o.rowType = :rowType
            ');
            $query->setParameters([
                'imdbNumber' => $this->imdbNumber,
                'rowType' => $this->tapeRowType
            ]);
            $query->useQueryCache(true);
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $query->getSingleResult();
            $this->tape = $this->getTapeByObject($imdbNumber->getObject());
            if (!$this->tape) {
                $this->tape = new Tape();
                $imdbNumber->getObject()->setTape($this->tape);
            }
        } catch (NoResultException $e) {
            $object = new GlobalUniqueObject();
            $object->setRowType($this->tapeRowType);
            $imdbNumber = new ImdbNumber();
            $imdbNumber->setImdbNumber($this->imdbNumber);
            $object->setImdbNumber($imdbNumber);
            $this->tape = new Tape();
            $object->setTape($this->tape);
        }
    }

    /**
     * @param array $sounds
     */
    protected function setSounds(array $sounds): void
    {
        /** @var EntityRepository $soundRepository */
        $soundRepository = $this->entityManager->getRepository(Sound::class);
        foreach ($sounds as $text) {
            /** @var Sound $sound */
            $sound = $soundRepository->findOneBy([
                "description" => $text
            ]);
            if ($sound) {
                $this->tape->addSound($sound);
            }
        }
    }

    /**
     * @param array $genres
     */
    protected function setGenres(array $genres): void
    {
        /** @var EntityRepository $genreRepository */
        $genreRepository = $this->entityManager->getRepository(Genre::class);
        foreach ($genres as $text) {
            /** @var Genre $genre */
            $genre = $genreRepository->findOneBy([
                "name" => $text
            ]);
            if ($genre) {
                $this->tape->addGenre($genre);
            }
        }
    }

    /**
     * @param array $languages
     */
    protected function setLanguages(array $languages): void
    {
        /** @var EntityRepository $languageRepository */
        $languageRepository = $this->entityManager->getRepository(Language::class);
        foreach ($languages as $text) {
            /** @var Language $language */
            $language = $languageRepository->findOneBy([
                "name" => $text
            ]);
            if ($language) {
                $this->tape->addLanguage($language);
            }
        }
    }

    /**
     * @param array $countries
     */
    protected function setCountries(array $countries): void
    {
        foreach ($countries as $text) {
            /** @var Country $country */
            $country = $this->countryRepository->findOneBy([
                "officialName" => $text
            ]);
            if ($country) {
                $this->tape->addCountry($country);
            }
        }
    }

    /**
     * @param HomeMapper $mapper
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    protected function setTvShowChapter(HomeMapper $mapper): void
    {
        /** @var TvShowChapter $tvShowChapter */
        $tvShowChapter = $this->entityManager->getRepository(TvShowChapter::class)->findOneBy([
            "tape" => $this->tape
        ]);
        if (!$tvShowChapter) {
            $qb = $this->entityManager->createQueryBuilder();
            $qb
                ->select('tv')
                ->from(TvShow::class, 'tv')
                ->innerJoin('tv.tape', 't')
                ->innerJoin('t.object', 'o')
                ->innerJoin('o.imdbNumber', 'i')
                ->where('i.imdbNumber = :imdbNumber')
                ->andWhere('o.rowType = :rowType')
                ->setParameters([
                    'imdbNumber' => $mapper->getTvShow(),
                    'rowType' => $this->tapeRowType
                ]);
            $query = $qb->getQuery();
            $query->useQueryCache(true);
            /** @var TvShow $tvShow */
            $tvShow = $query->getSingleResult();
            $tvShowChapter = new TvShowChapter();
            $tvShow->addChapter($tvShowChapter);
            $this->tape->setTvShowChapter($tvShowChapter);
        }
        $tvShowChapter->setSeason($mapper->getSeasonNumber());
        $tvShowChapter->setChapter($mapper->getEpisodeNumber());
    }

    /**
     * @throws Exception
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    protected function setDetails(): void
    {
        $mapper = new HomeMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $this->tape->setOriginalTitle($mapper->getTitle());
        $slug = $this->generator->generate($mapper->getTitle());
        /** @var SearchValue $searchValue */
        if ($slug && !$searchValue = $this->tape->getObject()->getSearchValue($slug)) {
            $searchValue = new SearchValue();
            $searchValue->setSearchParam($mapper->getTitle());
            $searchValue->setSlug($slug);
            $searchValue->setPrimaryParam(true);
            $this->tape->getObject()->addSearchValue($searchValue);
        }
        /** @var TapeDetail $tapeDetail */
        $tapeDetail = $this->entityManager->getRepository(TapeDetail::class)->findOneBy([
            "tape" => $this->tape
        ]);
        if (!$tapeDetail) {
            $tapeDetail = new TapeDetail();
            $this->tape->setDetail($tapeDetail);
        }
        $tapeDetail->setDuration($mapper->getDuration());
        $tapeDetail->setYear($mapper->getYear());
        $tapeDetail->setColor($mapper->getColor());
        $tapeDetail->setIsTvShow($mapper->isTvShow());
        $tapeDetail->setIsTvShowChapter($mapper->isEpisode());
        if ($tapeDetail->isTvShow()) {
            /** @var TvShow $tvShow */
            $tvShow = $this->entityManager->getRepository(TvShow::class)->findOneBy([
                "tape" => $this->tape
            ]);
            if (!$tvShow) {
                $tvShow = new TvShow();
                $this->tape->setTvShow($tvShow);
            }
        }
        /** @var Ranking $ranking */
        $ranking = $this->entityManager->getRepository(Ranking::class)->findOneBy([
            'object' => $this->tape->getObject()
        ]);
        if (!$ranking) {
            $ranking = new Ranking();
            $this->tape->getObject()->setRanking($ranking);
        }
        $ranking->setScoreFromCalculatedValue($mapper->getScore());
        $ranking->setVotes($mapper->getVotes());
        if ($tapeDetail->isTvShowChapter()) {
            $this->setTvShowChapter($mapper);
        }
        if ($sounds = $mapper->getSounds()) {
            $this->setSounds($sounds);
        }
        if ($genres = $mapper->getGenres()) {
            $this->setGenres($genres);
        }
        if ($languages = $mapper->getLanguages()) {
            $this->setLanguages($languages);
        }
        if ($countries = $mapper->getCountries()) {
            $this->setCountries($countries);
        }
    }

    /**
     * @throws Exception
     */
    protected function setKeywords(): void
    {
        $mapper = new KeywordMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $keywords = $mapper->getKeywords();
        if ($keywords->getIterator()->count()) {
            /** @var EntityRepository $tagRepository */
            $tagRepository = $this->entityManager->getRepository(Tag::class);
            /** @var Keyword $data */
            foreach ($keywords as $data) {
                /** @var Tag $tag */
                $tag = $tagRepository->findOneBy([
                    'keyword' => $data->getKeyword()
                ]);
                if (!$tag) {
                    $tag = new Tag();
                    $tag->setKeyword($data->getKeyword());
                }
                if ($tag) {
                    $this->tape->addTag($tag);
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function setLocations(): void
    {
        $mapper = new LocationMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $places = $mapper->getLocations();
        if ($places->getIterator()->count()) {
            /** @var EntityRepository $locationRepository */
            $locationRepository = $this->entityManager->getRepository(Location::class);
            /** @var Place $place */
            foreach ($places as $place) {
                /** @var Location $location */
                $location = $locationRepository->findOneBy([
                    'place' => $place->getLocation()
                ]);
                if (!$location) {
                    $location = new Location();
                    $location->setPlace($place->getLocation());
                }
                if ($location) {
                    $this->tape->addLocation($location);
                }
            }
        }
    }

    /**
     * @throws Exception
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    protected function setCast(): void
    {
        /** @var EntityRepository $roleRepository */
        $roleRepository = $this->entityManager->getRepository(Role::class);
        /** @var Role $castRole */
        $castRole = $roleRepository->findOneBy([
            "roleId" => ROLE::ROLE_CAST
        ]);
        $mapper = new CastMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $castIterator = $mapper->getCast();
        if ($castIterator->getIterator()->count()) {
            /** @var CastPeople $person */
            foreach ($castIterator as $person) {
                $people = $this->addTapePeople($person, $castRole);
                if ($person->getAlias()) {
                    /** @var PeopleAlias $peopleAlias */
                    if (!$peopleAlias = $people->getAlias($person->getAlias())) {
                        $peopleAlias = new PeopleAlias();
                        $peopleAlias->setAlias($person->getAlias());
                        $people->addAlias($peopleAlias);
                    }
                    $slug = $this->generator->generate($person->getAlias());
                    /** @var SearchValue $searchValue */
                    if ($slug && !$searchValue = $people->getObject()->getSearchValue($slug)) {
                        $searchValue = new SearchValue();
                        $searchValue->setSearchParam($person->getAlias());
                        $searchValue->setSlug($slug);
                        $people->getObject()->addSearchValue($searchValue);
                    }
                    /** @var PeopleAliasTape $peopleAliasTape */
                    if (!$peopleAliasTape = $this->tape->getPeopleAliasTape($peopleAlias)) {
                        $this->tape->addPeopleAlias($peopleAlias);
                    }
                }
            }
        }
        /** @var Role $directorRole */
        $directorRole = $roleRepository->findOneBy([
            "roleId" => ROLE::ROLE_DIRECTOR
        ]);
        $directors = $mapper->getDirectors();
        if ($directors->getIterator()->count()) {
            /** @var Person $person */
            foreach ($directors as $person) {
                $this->addTapePeople($person, $directorRole);
            }
        }
        /** @var Role $writerRole */
        $writerRole = $roleRepository->findOneBy([
            "roleId" => ROLE::ROLE_WRITER
        ]);
        $writers = $mapper->getWriters();
        if ($writers->getIterator()->count()) {
            $peopleChecked = [];
            /** @var Person $person */
            foreach ($writers as $person) {
                if (in_array($person->getImdbNumber(), $peopleChecked)) {
                    continue;
                }
                $peopleChecked[] = $person->getImdbNumber();
                $this->addTapePeople($person, $writerRole);
            }
        }
    }

    /**
     * @param ReleaseIterator $releaseDates
     */
    protected function setPremieres(ReleaseIterator $releaseDates): void
    {
        if ($releaseDates->getIterator()->count()) {
            /** @var Release $data */
            foreach ($releaseDates as $data) {
                if (!$data->getIsFullDate()) {
                    continue;
                }
                /** @var Country $country */
                if ($data->getCountry()) {
                    $country = $this->countryRepository->findOneBy([
                        'officialName' => $data->getCountry()
                    ]);
                } else {
                    $country = null;
                }
                /** @var Premiere $premiere */
                if (!$premiere = $this->tape->getPremiere($country, $data->getDate())) {
                    $premiere = new Premiere();
                    $premiere->setDate($data->getDate());
                    $premiere->setCountry($country);
                    $this->tape->addPremiere($premiere);
                }
                if ($data->getDetails()) {
                    foreach ($data->getDetails() as $detail) {
                        /** @var PremiereDetail $premiereDetail */
                        if (!$premiereDetail = $premiere->getDetail($detail)) {
                            $premiere->addObservation($detail);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param AlsoKnownAsIterator $titles
     */
    protected function setTitles(AlsoKnownAsIterator $titles): void
    {
        if ($titles->getIterator()->count()) {
            /** @var AlsoKnownAs $data */
            foreach ($titles as $data) {
                /** @var Country $country */
                if ($data->getCountry()) {
                    $country = $this->countryRepository->findOneBy([
                        'officialName' => $data->getCountry()
                    ]);
                } else {
                    $country = null;
                }
                /** @var TapeTitle $tapeTitle */
                if (!$tapeTitle = $this->tape->getTitle($country, $data->getTitle())) {
                    $tapeTitle = new TapeTitle();
                    $tapeTitle->setCountry($country);
                    $tapeTitle->setTitle($data->getTitle());
                    if ($country && $country->getLanguage()) {
                        $tapeTitle->setLanguage($country->getLanguage());
                    }
                    $this->tape->addTitle($tapeTitle);
                }
                $tapeTitle->setObservations($data->getDescription());
                $slug = $this->generator->generate($data->getTitle());
                if ($slug && !$searchValue = $this->tape->getObject()->getSearchValue($slug)) {
                    $searchValue = new SearchValue();
                    $searchValue->setSearchParam($data->getTitle());
                    $searchValue->setSlug($slug);
                    $this->tape->getObject()->addSearchValue($searchValue);
                }
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function setPremieresAndTitles(): void
    {
        $mapper = new ReleaseMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $this->setPremieres($mapper->getReleaseDates());
        $this->setTitles($mapper->getAlsoKnownAs());
    }

    /**
     * @throws Exception
     */
    protected function setCertifications(): void
    {
        $mapper = new ParentalGuideMapper();
        $mapper->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        $certificates = $mapper->getCertificates();
        if ($certificates->getIterator()->count()) {
            /** @var Certificate $certificate */
            foreach ($certificates as $certificate) {
                /** @var Country $country */
                $country = $this->countryRepository->findOneBy([
                    'officialName' => $certificate->getCountryName()
                ]);
                if (!$country && $certificate->getIsoCountryCode()) {
                    $country = $this->countryRepository->findOneBy([
                        'isoCode' => $certificate->getIsoCountryCode()
                    ]);
                }
                if ($country) {
                    /** @var TapeCertification $tapeCertification */
                    if (!$tapeCertification = $this->tape->getCertification($country)) {
                        $tapeCertification = new TapeCertification();
                        $tapeCertification->setCountry($country);
                    }
                    $tapeCertification->setCertification($certificate->getCertification());
                    $this->tape->addCertification($tapeCertification);
                }
            }
        }
    }

    /**
     * @throws Exception
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    public function import(): void
    {
        $this->setTape();
        $this->setDetails();
        $this->setKeywords();
        $this->setLocations();
        $this->setCast();
        $this->setPremieresAndTitles();
        $this->setCertifications();
    }

    /**
     * @param GlobalUniqueObject $object
     * @return Tape|null
     */
    protected function getTapeByObject(GlobalUniqueObject $object): ?Tape
    {
        /** @var Tape $tape */
        $tape = $this->entityManager->getRepository(Tape::class)->findOneBy([
            "object" => $object
        ]);
        return $tape;
    }

    /**
     * @param int $rowTypeId
     * @return RowType
     */
    protected function getRowType(int $rowTypeId): RowType
    {
        /** @var RowType $rowType */
        $rowType = $this->entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => $rowTypeId
        ]);
        return $rowType;
    }
}
