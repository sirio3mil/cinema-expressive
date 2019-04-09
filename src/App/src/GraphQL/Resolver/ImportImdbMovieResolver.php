<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:23
 */

namespace App\GraphQL\Resolver;

use App\Alias\MongoDBClient;
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

class ImportImdbMovieResolver
{

    /** @var RowType */
    public static $peopleRowType;

    /**
     * @param EntityManager $entityManager
     * @param Person $person
     * @return People|null
     * @throws NonUniqueResultException
     */
    public static function getPeopleByImdbNumber(EntityManager $entityManager, Person $person): ?People
    {
        /** @var Query $query */
        $query = $entityManager->createQuery('
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
     * @param EntityManager $entityManager
     * @param Person $person
     * @return People
     * @throws ORMException
     */
    public static function createPeopleFromPerson(EntityManager $entityManager, Person $person): People
    {
        $object = new GlobalUniqueObject();
        $object->setRowType(self::$peopleRowType);
        $entityManager->persist($object);
        $people = new People();
        $people->setObject($object);
        $people->setFullName($person->getFullName());
        $entityManager->persist($people);
        $imdbNumber = new ImdbNumber();
        $imdbNumber->setImdbNumber($person->getImdbNumber());
        $imdbNumber->setObject($object);
        $entityManager->persist($imdbNumber);
        $searchValue = new SearchValue();
        $searchValue->setSearchParam($person->getFullName());
        $searchValue->setPrimaryParam(true);
        $people->getObject()->addSearchValue($searchValue);
        return $people;
    }

    /**
     * @param EntityManager $entityManager
     * @param Person $person
     * @param Role $role
     * @param Tape $tape
     * @return People
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    public static function addTapePeople(EntityManager $entityManager, Person $person, Role $role, Tape $tape): People
    {
        /** @var People $people */
        if (!$people = self::getPeopleByImdbNumber($entityManager, $person)) {
            $people = self::createPeopleFromPerson($entityManager, $person);
        }
        /** @var TapePeopleRole $tapePeopleRole */
        if (!$tapePeopleRole = $tape->getTapePeopleRole($people, $role)) {
            $tapePeopleRole = new TapePeopleRole();
            $tapePeopleRole->setRole($role);
            $tapePeopleRole->setPeople($people);
            $tape->addPeople($tapePeopleRole);
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
     * @param ContainerInterface $container
     * @param array $args
     * @return Tape
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public static function resolve(ContainerInterface $container, array $args): Tape
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var RowType $tapeRowType */
        $tapeRowType = $entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_TAPE
        ]);
        try {
            /** @var Query $query */
            $query = $entityManager->createQuery('
                SELECT i 
                FROM App\Entity\ImdbNumber i 
                JOIN i.object o 
                WHERE i.imdbNumber = :imdbNumber 
                    AND o.rowType = :rowType
            ');
            $query->setParameters([
                'imdbNumber' => $args['imdbNumber'],
                'rowType' => $tapeRowType
            ]);
            $query->useQueryCache(true);
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $query->getSingleResult();
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                "object" => $imdbNumber->getObject()
            ]);
            if (!$tape) {
                $tape = new Tape();
                $imdbNumber->getObject()->setTape($tape);
            }
        } catch (NoResultException $e) {
            $object = new GlobalUniqueObject();
            $object->setRowType($tapeRowType);
            $imdbNumber = new ImdbNumber();
            $imdbNumber->setImdbNumber($args['imdbNumber']);
            $object->setImdbNumber($imdbNumber);
            $tape = new Tape();
            $object->setTape($tape);
        }
        /** @var array $imdbMovieDetails */
        $imdbMovieDetails = ImdbMovieDetailResolver::resolve($container, $args);
        $tape->setOriginalTitle($imdbMovieDetails['title']);
        /** @var EntityRepository $searchValueRepository */
        $searchValueRepository = $entityManager->getRepository(SearchValue::class);
        /** @var SearchValue $searchValue */
        $searchValue = $searchValueRepository->findOneBy([
            'object' => $tape->getObject(),
            'searchParam' => $imdbMovieDetails['title']
        ]);
        if (!$searchValue) {
            $searchValue = new SearchValue();
            $searchValue->setSearchParam($imdbMovieDetails['title']);
            $searchValue->setPrimaryParam(true);
            $tape->getObject()->addSearchValue($searchValue);
        }
        /** @var TapeDetail $tapeDetail */
        $tapeDetail = $entityManager->getRepository(TapeDetail::class)->findOneBy([
            "tape" => $tape
        ]);
        if (!$tapeDetail) {
            $tapeDetail = new TapeDetail();
            $tape->setDetail($tapeDetail);
        }
        $tapeDetail->setDuration($imdbMovieDetails['duration']);
        $tapeDetail->setYear($imdbMovieDetails['year']);
        $tapeDetail->setColor($imdbMovieDetails['color']);
        $tapeDetail->setIsTvShow($imdbMovieDetails['isTvShow']);
        /** @var Ranking $ranking */
        $ranking = $entityManager->getRepository(Ranking::class)->findOneBy([
            'object' => $tape->getObject()
        ]);
        if (!$ranking) {
            $ranking = new Ranking();
            $tape->getObject()->setRanking($ranking);
        }
        $ranking->setScoreFromCalculatedValue($imdbMovieDetails['score']);
        $ranking->setVotes($imdbMovieDetails['votes']);
        if ($imdbMovieDetails['sounds']) {
            /** @var EntityRepository $soundRepository */
            $soundRepository = $entityManager->getRepository(Sound::class);
            foreach ($imdbMovieDetails['sounds'] as $text) {
                /** @var Sound $sound */
                $sound = $soundRepository->findOneBy([
                    "description" => $text
                ]);
                if ($sound) {
                    $tape->addSound($sound);
                }
            }
        }
        $entityManager->persist($tape);
        if ($imdbMovieDetails['genres']) {
            /** @var EntityRepository $genreRepository */
            $genreRepository = $entityManager->getRepository(Genre::class);
            foreach ($imdbMovieDetails['genres'] as $text) {
                /** @var Genre $genre */
                $genre = $genreRepository->findOneBy([
                    "name" => $text
                ]);
                if ($genre) {
                    $tape->addGenre($genre);
                }
            }
        }
        if ($imdbMovieDetails['languages']) {
            /** @var EntityRepository $languageRepository */
            $languageRepository = $entityManager->getRepository(Language::class);
            foreach ($imdbMovieDetails['languages'] as $text) {
                /** @var Language $language */
                $language = $languageRepository->findOneBy([
                    "name" => $text
                ]);
                if ($language) {
                    $tape->addLanguage($language);
                }
            }
        }
        /** @var EntityRepository $countryRepository */
        $countryRepository = $entityManager->getRepository(Country::class);
        if ($imdbMovieDetails['countries']) {
            foreach ($imdbMovieDetails['countries'] as $text) {
                /** @var Country $country */
                $country = $countryRepository->findOneBy([
                    "officialName" => $text
                ]);
                if ($country) {
                    $tape->addCountry($country);
                }
            }
        }
        /** @var array $imdbMovieKeywords */
        $imdbMovieKeywords = ImdbMovieKeywordResolver::resolve($container, $args);
        if ($imdbMovieKeywords && array_key_exists('keywords', $imdbMovieKeywords)) {
            /** @var KeywordIterator $keywords */
            $keywords = $imdbMovieKeywords['keywords'];
            if ($keywords->getIterator()->count()) {
                /** @var EntityRepository $tagRepository */
                $tagRepository = $entityManager->getRepository(Tag::class);
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
                        $tape->addTag($tag);
                    }
                }
            }
        }
        /** @var array $imdbMovieLocations */
        $imdbMovieLocations = ImdbMovieLocationResolver::resolve($container, $args);
        if ($imdbMovieLocations) {
            /** @var EntityRepository $locationRepository */
            $locationRepository = $entityManager->getRepository(Location::class);
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
                    $tape->addLocation($location);
                }
            }
        }
        if ($tapeDetail->getIsTvShow()) {
            /** @var TvShow $tvShow */
            $tvShow = $entityManager->getRepository(TvShow::class)->findOneBy([
                "tape" => $tape
            ]);
            if (!$tvShow) {
                $tvShow = new TvShow();
                $tape->setTvShow($tvShow);
            }
        }
        if ($imdbMovieDetails['isEpisode']) {
            /** @var TvShowChapter $tvShowChapter */
            $tvShowChapter = $entityManager->getRepository(TvShowChapter::class)->findOneBy([
                "tape" => $tape
            ]);
            if (!$tvShowChapter) {
                /** @var Query $query */
                $query = $entityManager->createQuery('
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
                    'imdbNumber' => $imdbMovieDetails['tvShow'],
                    'rowType' => $tapeRowType
                ]);
                $query->useQueryCache(true);
                /** @var TvShow $tvShow */
                $tvShow = $query->getSingleResult();
                $tvShowChapter = new TvShowChapter();
                $tvShow->addChapter($tvShowChapter);
                $tape->setTvShowChapter($tvShowChapter);
            }
            $tvShowChapter->setSeason($imdbMovieDetails['seasonNumber']);
            $tvShowChapter->setChapter($imdbMovieDetails['episodeNumber']);
        }
        /** @var Role $castRole */
        $castRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_CAST
        ]);
        /** @var RowType peopleRowType */
        self::$peopleRowType = $entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_PEOPLE
        ]);
        /** @var array $imdbMovieCredits */
        $imdbMovieCredits = ImdbMovieCastResolver::resolve($container, $args);
        /** @var CastIterator $castIterator */
        $castIterator = $imdbMovieCredits['cast'];
        if ($castIterator->getIterator()->count()) {
            /** @var EntityRepository $peopleAliasRepository */
            $peopleAliasRepository = $entityManager->getRepository(PeopleAlias::class);
            /** @var CastPeople $person */
            foreach ($castIterator as $person) {
                $people = self::addTapePeople($entityManager, $person, $castRole, $tape);
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
                    $searchValue = $searchValueRepository->findOneBy([
                        'object' => $people->getObject(),
                        'searchParam' => $person->getAlias()
                    ]);
                    if (!$searchValue) {
                        $searchValue = new SearchValue();
                        $searchValue->setSearchParam($person->getAlias());
                        $people->getObject()->addSearchValue($searchValue);
                    }
                    /** @var PeopleAliasTape $peopleAliasTape */
                    if (!$peopleAliasTape = $tape->getPeopleAliasTape($peopleAlias)) {
                        $tape->addPeopleAlias($peopleAlias);
                    }
                }
            }
        }
        /** @var Role $directorRole */
        $directorRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_DIRECTOR
        ]);
        /** @var PersonIterator $directors */
        $directors = $imdbMovieCredits['directors'];
        if ($directors->getIterator()->count()) {
            /** @var Person $person */
            foreach ($directors as $person) {
                self::addTapePeople($entityManager, $person, $directorRole, $tape);
            }
        }
        /** @var Role $writerRole */
        $writerRole = $entityManager->getRepository(Role::class)->findOneBy([
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
                self::addTapePeople($entityManager, $person, $writerRole, $tape);
            }
        }
        /** @var array $imdbMovieReleases */
        $imdbMovieReleases = ImdbMovieReleaseResolver::resolve($container, $args);
        /** @var ReleaseIterator $releaseDates */
        $releaseDates = $imdbMovieReleases['dates'];
        if ($releaseDates->getIterator()->count()) {
            /** @var Release $data */
            foreach ($releaseDates as $data) {
                if (!$data->getIsFullDate()) {
                    continue;
                }
                /** @var Country $country */
                if ($data->getCountry()) {
                    $country = $countryRepository->findOneBy([
                        'officialName' => $data->getCountry()
                    ]);
                } else {
                    $country = null;
                }
                /** @var Premiere $premiere */
                if (!$premiere = $tape->getPremiere($country, $data->getDate())) {
                    $premiere = new Premiere();
                    $premiere->setDate($data->getDate());
                    $premiere->setCountry($country);
                    $tape->addPremiere($premiere);
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
        /** @var AlsoKnownAsIterator $titles */
        $titles = $imdbMovieReleases['titles'];
        if ($titles->getIterator()->count()) {
            /** @var AlsoKnownAs $data */
            foreach ($titles as $data) {
                /** @var Country $country */
                if ($data->getCountry()) {
                    $country = $countryRepository->findOneBy([
                        'officialName' => $data->getCountry()
                    ]);
                } else {
                    $country = null;
                }
                /** @var TapeTitle $tapeTitle */
                if (!$tapeTitle = $tape->getTitle($country, $data->getTitle())) {
                    $tapeTitle = new TapeTitle();
                    $tapeTitle->setCountry($country);
                    $tapeTitle->setTitle($data->getTitle());
                    if ($country && $country->getLanguage()) {
                        $tapeTitle->setLanguage($country->getLanguage());
                    }
                    $tape->addTitle($tapeTitle);
                }
                $tapeTitle->setObservations($data->getDescription());
                /** @var SearchValue $searchValue */
                $searchValue = $searchValueRepository->findOneBy([
                    'object' => $tape->getObject(),
                    'searchParam' => $data->getTitle()
                ]);
                if (!$searchValue) {
                    $searchValue = new SearchValue();
                    $searchValue->setSearchParam($data->getTitle());
                    $tape->getObject()->addSearchValue($searchValue);
                }
            }
        }
        /** @var array $imdbMovieCertifications */
        $imdbMovieCertifications = ImdbMovieCertificateResolver::resolve($container, $args);
        if ($imdbMovieCertifications) {
            foreach ($imdbMovieCertifications as $data) {
                /** @var Country $country */
                $country = $countryRepository->findOneBy([
                    'officialName' => $data['country']
                ]);
                if ($country) {
                    /** @var TapeCertification $tapeCertification */
                    if (!$tapeCertification = $tape->getCertification($country)) {
                        $tapeCertification = new TapeCertification();
                        $tapeCertification->setCountry($country);
                    }
                    $tapeCertification->setCertification($data['certification']);
                    $tape->addCertification($tapeCertification);
                }
            }
        }
        $entityManager->flush();
        return $tape;
    }
}