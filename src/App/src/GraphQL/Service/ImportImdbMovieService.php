<?php


namespace App\GraphQL\Service;

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
use App\GraphQL\Resolver\ImdbMovieCastResolver;
use App\GraphQL\Resolver\ImdbMovieCertificateResolver;
use App\GraphQL\Resolver\ImdbMovieDetailResolver;
use App\GraphQL\Resolver\ImdbMovieKeywordResolver;
use App\GraphQL\Resolver\ImdbMovieLocationResolver;
use App\GraphQL\Resolver\ImdbMovieReleaseResolver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\OptimisticLockException;
use ImdbScraper\Iterator\AlsoKnownAsIterator;
use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Iterator\KeywordIterator;
use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Iterator\ReleaseIterator;
use ImdbScraper\Model\AlsoKnownAs;
use ImdbScraper\Model\CastPeople;
use ImdbScraper\Model\Keyword;
use ImdbScraper\Model\Release;
use ImdbScraper\Model\People as Person;
use Interop\Container\ContainerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Void_;

class ImportImdbMovieService
{
    /** @var RowType */
    protected $peopleRowType;

    /** @var RowType */
    protected $tapeRowType;

    /** @var EntityManager */
    protected $entityManager;

    /** @var ContainerInterface */
    protected $container;

    /** @var EntityRepository */
    protected $countryRepository;

    /** @var EntityRepository */
    protected $searchValueRepository;

    /** @var Tape */
    protected $tape;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        /** @var EntityManager $entityManager */
        $this->entityManager = $container->get(EntityManager::class);
        /** @var EntityRepository $rowTypeRepository */
        $rowTypeRepository = $this->entityManager->getRepository(RowType::class);
        /** @var RowType peopleRowType */
        $this->peopleRowType = $rowTypeRepository->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_PEOPLE
        ]);
        /** @var RowType tapeRowType */
        $this->tapeRowType = $rowTypeRepository->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_TAPE
        ]);
        /** @var EntityRepository $countryRepository */
        $this->countryRepository = $this->entityManager->getRepository(Country::class);
        /** @var EntityRepository $searchValueRepository */
        $this->searchValueRepository = $this->entityManager->getRepository(SearchValue::class);
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
        /** @var Query $query */
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
        $searchValue->setPrimaryParam(true);
        $people->getObject()->addSearchValue($searchValue);
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
     * @param int $number
     * @throws NonUniqueResultException
     */
    protected function setTape(int $number): void
    {
        try {
            /** @var Query $query */
            $query = $this->entityManager->createQuery('
                SELECT i 
                FROM App\Entity\ImdbNumber i 
                JOIN i.object o 
                WHERE i.imdbNumber = :imdbNumber 
                    AND o.rowType = :rowType
            ');
            $query->setParameters([
                'imdbNumber' => $number,
                'rowType' => $this->tapeRowType
            ]);
            $query->useQueryCache(true);
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $query->getSingleResult();
            /** @var Tape $tape */
            $this->tape = $this->entityManager->getRepository(Tape::class)->findOneBy([
                "object" => $imdbNumber->getObject()
            ]);
            if (!$this->tape) {
                $this->tape = new Tape();
                $imdbNumber->getObject()->setTape($this->tape);
            }
        } catch (NoResultException $e) {
            $object = new GlobalUniqueObject();
            $object->setRowType($this->tapeRowType);
            $imdbNumber = new ImdbNumber();
            $imdbNumber->setImdbNumber($number);
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
     * @param array $data
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    protected function setTvShowChapter(array $data): void
    {
        /** @var TvShowChapter $tvShowChapter */
        $tvShowChapter = $this->entityManager->getRepository(TvShowChapter::class)->findOneBy([
            "tape" => $this->tape
        ]);
        if (!$tvShowChapter) {
            /** @var Query $query */
            $query = $this->entityManager->createQuery('
                    SELECT tv 
                    FROM App\Entity\TvShow tv 
                    JOIN tv.tape t 
                    JOIN App\Entity\ImdbNumber i 
                        WITH i.object = t.object
                    JOIN i.object o 
                    WHERE i.imdbNumber = :imdbNumber 
                        AND o.rowType = :rowType
                ');
            $query->setParameters([
                'imdbNumber' => $data['tvShow'],
                'rowType' => $this->tapeRowType
            ]);
            $query->useQueryCache(true);
            /** @var TvShow $tvShow */
            $tvShow = $query->getSingleResult();
            $tvShowChapter = new TvShowChapter();
            $tvShow->addChapter($tvShowChapter);
            $this->tape->setTvShowChapter($tvShowChapter);
        }
        $tvShowChapter->setSeason($data['seasonNumber']);
        $tvShowChapter->setChapter($data['episodeNumber']);
    }

    /**
     * @param array $args
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    protected function setDetails(array $args): void
    {
        /** @var array $imdbMovieDetails */
        $imdbMovieDetails = ImdbMovieDetailResolver::resolve($this->container, $args);
        $this->tape->setOriginalTitle($imdbMovieDetails['title']);
        /** @var SearchValue $searchValue */
        $searchValue = $this->searchValueRepository->findOneBy([
            'object' => $this->tape->getObject(),
            'searchParam' => $imdbMovieDetails['title']
        ]);
        if (!$searchValue) {
            $searchValue = new SearchValue();
            $searchValue->setSearchParam($imdbMovieDetails['title']);
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
        $tapeDetail->setDuration($imdbMovieDetails['duration']);
        $tapeDetail->setYear($imdbMovieDetails['year']);
        $tapeDetail->setColor($imdbMovieDetails['color']);
        $tapeDetail->setIsTvShow($imdbMovieDetails['isTvShow']);
        if ($tapeDetail->getIsTvShow()) {
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
        $ranking->setScoreFromCalculatedValue($imdbMovieDetails['score']);
        $ranking->setVotes($imdbMovieDetails['votes']);
        if ($imdbMovieDetails['isEpisode']) {
            $this->setTvShowChapter($imdbMovieDetails);
        }
        if ($imdbMovieDetails['sounds']) {
            $this->setSounds($imdbMovieDetails['sounds']);
        }
        if ($imdbMovieDetails['genres']) {
            $this->setGenres($imdbMovieDetails['genres']);
        }
        if ($imdbMovieDetails['languages']) {
            $this->setLanguages($imdbMovieDetails['languages']);
        }
        if ($imdbMovieDetails['countries']) {
            $this->setCountries($imdbMovieDetails['countries']);
        }
    }

    /**
     * @param array $args
     * @throws Exception
     */
    protected function setKeywords(array $args): void
    {
        /** @var array $imdbMovieKeywords */
        $imdbMovieKeywords = ImdbMovieKeywordResolver::resolve($this->container, $args);
        if ($imdbMovieKeywords && array_key_exists('keywords', $imdbMovieKeywords)) {
            /** @var KeywordIterator $keywords */
            $keywords = $imdbMovieKeywords['keywords'];
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
    }

    /**
     * @param array $args
     * @throws Exception
     */
    protected function setLocations(array $args): void
    {
        /** @var array $imdbMovieLocations */
        $imdbMovieLocations = ImdbMovieLocationResolver::resolve($this->container, $args);
        if ($imdbMovieLocations) {
            /** @var EntityRepository $locationRepository */
            $locationRepository = $this->entityManager->getRepository(Location::class);
            foreach ($imdbMovieLocations as $data) {
                /** @var Location $location */
                $location = $locationRepository->findOneBy([
                    'place' => $data['location']
                ]);
                if (!$location) {
                    $location = new Location();
                    $location->setPlace($data['location']);
                }
                if ($location) {
                    $this->tape->addLocation($location);
                }
            }
        }
    }

    /**
     * @param array $args
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    protected function setCast(array $args): void
    {
        /** @var EntityRepository $roleRepository */
        $roleRepository = $this->entityManager->getRepository(Role::class);
        /** @var Role $castRole */
        $castRole = $roleRepository->findOneBy([
            "roleId" => ROLE::ROLE_CAST
        ]);
        /** @var array $imdbMovieCredits */
        $imdbMovieCredits = ImdbMovieCastResolver::resolve($this->container, $args);
        /** @var CastIterator $castIterator */
        $castIterator = $imdbMovieCredits['cast'];
        if ($castIterator->getIterator()->count()) {
            /** @var EntityRepository $peopleAliasRepository */
            $peopleAliasRepository = $this->entityManager->getRepository(PeopleAlias::class);
            /** @var CastPeople $person */
            foreach ($castIterator as $person) {
                $people = $this->addTapePeople($person, $castRole);
                if (!empty($person->getAlias())) {
                    /** @var PeopleAlias $peopleAlias */
                    $peopleAlias = $peopleAliasRepository->findOneBy([
                        "people" => $people,
                        "alias" => $person->getAlias()
                    ]);
                    if (!$peopleAlias) {
                        $peopleAlias = new PeopleAlias();
                        $peopleAlias->setAlias($person->getAlias());
                        $people->addAlias($peopleAlias);
                    }
                    /** @var SearchValue $searchValue */
                    $searchValue = $this->searchValueRepository->findOneBy([
                        'object' => $people->getObject(),
                        'searchParam' => $person->getAlias()
                    ]);
                    if (!$searchValue) {
                        $searchValue = new SearchValue();
                        $searchValue->setSearchParam($person->getAlias());
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
        /** @var PersonIterator $directors */
        $directors = $imdbMovieCredits['directors'];
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
        /** @var PersonIterator $writers */
        $writers = $imdbMovieCredits['writers'];
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
                /** @var SearchValue $searchValue */
                $searchValue = $this->searchValueRepository->findOneBy([
                    'object' => $this->tape->getObject(),
                    'searchParam' => $data->getTitle()
                ]);
                if (!$searchValue) {
                    $searchValue = new SearchValue();
                    $searchValue->setSearchParam($data->getTitle());
                    $this->tape->getObject()->addSearchValue($searchValue);
                }
            }
        }
    }

    /**
     * @param array $args
     * @throws Exception
     */
    protected function setPremieresAndTitles(array $args): void
    {
        /** @var array $imdbMovieReleases */
        $imdbMovieReleases = ImdbMovieReleaseResolver::resolve($this->container, $args);
        $this->setPremieres($imdbMovieReleases['dates']);
        $this->setTitles($imdbMovieReleases['titles']);
    }

    /**
     * @param array $args
     * @throws Exception
     */
    protected function setCertifications(array $args): void
    {
        /** @var array $imdbMovieCertifications */
        $imdbMovieCertifications = ImdbMovieCertificateResolver::resolve($this->container, $args);
        if ($imdbMovieCertifications) {
            foreach ($imdbMovieCertifications as $data) {
                /** @var Country $country */
                $country = $this->countryRepository->findOneBy([
                    'officialName' => $data['country']
                ]);
                if ($country) {
                    /** @var TapeCertification $tapeCertification */
                    if (!$tapeCertification = $this->tape->getCertification($country)) {
                        $tapeCertification = new TapeCertification();
                        $tapeCertification->setCountry($country);
                    }
                    $tapeCertification->setCertification($data['certification']);
                    $this->tape->addCertification($tapeCertification);
                }
            }
        }
    }

    /**
     * @param array $args
     * @return Tape
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    public function import(array $args): Tape
    {
        $this->setTape($args['imdbNumber']);
        $this->setDetails($args);
        $this->setKeywords($args);
        $this->setLocations($args);
        $this->setCast($args);
        $this->setPremieresAndTitles($args);
        $this->setCertifications($args);
        return $this->tape;
    }
}
