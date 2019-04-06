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
     * @param Role $role
     * @param Tape $tape
     * @return array
     */
    public static function getPeopleByTapeAndRole(EntityManager $entityManager, Role $role, Tape $tape): array
    {
        /** @var Query $query */
        $query = $entityManager->createQuery('
            SELECT r tapePeopleRole
              ,i.imdbNumber
            FROM App\Entity\TapePeopleRole r
            JOIN r.people p
            JOIN App\Entity\ImdbNumber i 
              WITH i.object = p.object
            WHERE r.role = :role 
              AND r.tape = :tape
        ');
        $query->setParameters([
            'role' => $role,
            'tape' => $tape
        ]);
        $query->useQueryCache(true);
        /** @var array $result */
        $dqlQueryResult = $query->getResult();
        $cast = [];
        foreach ($dqlQueryResult as $row) {
            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
        }
        return $cast;
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
        $searchValue->setObject($people->getObject());
        $searchValue->setSearchParam($person->getFullName());
        $searchValue->setPrimaryParam(true);
        $entityManager->persist($searchValue);
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
                $tape->setObject($imdbNumber->getObject());
            }
        } catch (NoResultException $e) {
            $object = new GlobalUniqueObject();
            $object->setRowType($tapeRowType);
            $imdbNumber = new ImdbNumber();
            $imdbNumber->setImdbNumber($args['imdbNumber']);
            $object->setImdbNumber($imdbNumber);
            $tape = new Tape();
            $tape->setObject($object);
        }
        /** @var array $imdbMovieDetails */
        $imdbMovieDetails = ImdbMovieDetailResolver::resolve($container, $args);
        $tape->setOriginalTitle($imdbMovieDetails['title']);
        $entityManager->persist($tape);
        /** @var EntityRepository $searchValueRepository */
        $searchValueRepository = $entityManager->getRepository(SearchValue::class);
        /** @var SearchValue $searchValue */
        $searchValue = $searchValueRepository->findOneBy([
            'object' => $tape->getObject(),
            'searchParam' => $imdbMovieDetails['title']
        ]);
        if (!$searchValue) {
            $searchValue = new SearchValue();
            $searchValue->setObject($tape->getObject());
            $searchValue->setSearchParam($imdbMovieDetails['title']);
            $searchValue->setPrimaryParam(true);
            $entityManager->persist($searchValue);
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
        $entityManager->flush();
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
                $entityManager->flush();
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
            $entityManager->flush();
        }
        if ($tapeDetail->getIsTvShow()) {
            /** @var TvShow $tvShow */
            $tvShow = $entityManager->getRepository(TvShow::class)->findOneBy([
                "tape" => $tape
            ]);
            if (!$tvShow) {
                $tvShow = new TvShow();
                $tape->setTvShow($tvShow);
                $entityManager->flush();
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
        $entityManager->flush();
        /** @var Role $castRole */
        $castRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_CAST
        ]);
        /** @var RowType peopleRowType */
        self::$peopleRowType = $entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_PEOPLE
        ]);
        $cast = self::getPeopleByTapeAndRole($entityManager, $castRole, $tape);
        /** @var array $imdbMovieCredits */
        $imdbMovieCredits = ImdbMovieCastResolver::resolve($container, $args);
        /** @var CastIterator $castIterator */
        $castIterator = $imdbMovieCredits['cast'];
        if ($castIterator->getIterator()->count()) {
            /** @var CastPeople $person */
            foreach ($castIterator as $person) {
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person->getImdbNumber(), $cast)) {
                    $tapePeopleRole = $cast[$person->getImdbNumber()];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    $people = self::getPeopleByImdbNumber($entityManager, $person);
                }
                if (!$people) {
                    $people = self::createPeopleFromPerson($entityManager, $person);
                }
                if (!$tapePeopleRole) {
                    $tapePeopleRole = new TapePeopleRole();
                    $tapePeopleRole->setTape($tape);
                    $tapePeopleRole->setRole($castRole);
                    $tapePeopleRole->setPeople($people);
                    $entityManager->persist($tapePeopleRole);
                }
                $entityManager->flush();
                if (!empty($person->getAlias())) {
                    /** @var PeopleAlias $peopleAlias */
                    $peopleAlias = $entityManager->getRepository(PeopleAlias::class)->findOneBy([
                        "people" => $people,
                        "alias" => $person->getAlias()
                    ]);
                    if (!$peopleAlias) {
                        $peopleAlias = new PeopleAlias();
                        $peopleAlias->setPeople($people);
                        $peopleAlias->setAlias($person->getAlias());
                        $entityManager->persist($peopleAlias);
                        $entityManager->flush();
                    }
                    /** @var SearchValue $searchValue */
                    $searchValue = $searchValueRepository->findOneBy([
                        'object' => $people->getObject(),
                        'searchParam' => $person->getAlias()
                    ]);
                    if (!$searchValue) {
                        $searchValue = new SearchValue();
                        $searchValue->setObject($people->getObject());
                        $searchValue->setSearchParam($person->getAlias());
                        $entityManager->persist($searchValue);
                    }
                    /** @var PeopleAliasTape $peopleAliasTape */
                    $peopleAliasTape = $entityManager->getRepository(PeopleAliasTape::class)->findOneBy([
                        "peopleAlias" => $peopleAlias,
                        "tape" => $tape
                    ]);
                    if (!$peopleAliasTape) {
                        $peopleAliasTape = new PeopleAliasTape();
                        $peopleAliasTape->setTape($tape);
                        $peopleAliasTape->setPeopleAlias($peopleAlias);
                        $entityManager->persist($peopleAliasTape);
                        $entityManager->flush();
                    }
                }
                if (!empty($person->getCharacter())) {
                    /** @var TapePeopleRoleCharacter $peopleAliasTape */
                    $tapePeopleRoleCharacter = $entityManager->getRepository(TapePeopleRoleCharacter::class)
                        ->findOneBy([
                            "tapePeopleRole" => $tapePeopleRole
                        ]);
                    if (!$tapePeopleRoleCharacter) {
                        $tapePeopleRoleCharacter = new TapePeopleRoleCharacter();
                        $tapePeopleRoleCharacter->setTapePeopleRole($tapePeopleRole);
                    }
                    $tapePeopleRoleCharacter->setCharacter($person->getCharacter());
                    $entityManager->persist($tapePeopleRoleCharacter);
                    $entityManager->flush();
                }
            }
        }
        /** @var Role $directorRole */
        $directorRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_DIRECTOR
        ]);
        $cast = self::getPeopleByTapeAndRole($entityManager, $directorRole, $tape);
        /** @var PersonIterator $directors */
        $directors = $imdbMovieCredits['directors'];
        if ($directors->getIterator()->count()) {
            /** @var Person $person */
            foreach ($directors as $person) {
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person->getImdbNumber(), $cast)) {
                    $tapePeopleRole = $cast[$person->getImdbNumber()];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    $people = self::getPeopleByImdbNumber($entityManager, $person);
                }
                if (!$people) {
                    $people = self::createPeopleFromPerson($entityManager, $person);
                }
                if (!$tapePeopleRole) {
                    $tapePeopleRole = new TapePeopleRole();
                    $tapePeopleRole->setTape($tape);
                    $tapePeopleRole->setRole($directorRole);
                    $tapePeopleRole->setPeople($people);
                    $entityManager->persist($tapePeopleRole);
                }
                $entityManager->flush();
            }
        }
        /** @var Role $writerRole */
        $writerRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_WRITER
        ]);
        $cast = self::getPeopleByTapeAndRole($entityManager, $writerRole, $tape);
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
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person->getImdbNumber(), $cast)) {
                    $tapePeopleRole = $cast[$person->getImdbNumber()];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    $people = self::getPeopleByImdbNumber($entityManager, $person);
                }
                if (!$people) {
                    $people = self::createPeopleFromPerson($entityManager, $person);
                }
                if (!$tapePeopleRole) {
                    $tapePeopleRole = new TapePeopleRole();
                    $tapePeopleRole->setTape($tape);
                    $tapePeopleRole->setRole($writerRole);
                    $tapePeopleRole->setPeople($people);
                    $entityManager->persist($tapePeopleRole);
                }
                $entityManager->flush();
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
                $premiere = $entityManager->getRepository(Premiere::class)->findOneBy([
                    'tape' => $tape,
                    'date' => $data->getDate(),
                    'country' => $country
                ]);
                if (!$premiere) {
                    $premiere = new Premiere();
                    $premiere->setTape($tape);
                    $premiere->setDate($data->getDate());
                    $premiere->setCountry($country);
                    $entityManager->persist($premiere);
                    $entityManager->flush();
                }
                if ($data->getDetails()) {
                    foreach ($data->getDetails() as $detail) {
                        /** @var PremiereDetail $premiereDetail */
                        $premiereDetail = $entityManager->getRepository(PremiereDetail::class)->findOneBy([
                            'premiere' => $premiere,
                            'observation' => $detail
                        ]);
                        if (!$premiereDetail) {
                            $premiereDetail = new PremiereDetail();
                            $premiereDetail->setPremiere($premiere);
                            $premiereDetail->setObservation($detail);
                            $entityManager->persist($premiereDetail);
                            $entityManager->flush();
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
                $tapeTitle = $entityManager->getRepository(TapeTitle::class)->findOneBy([
                    'tape' => $tape,
                    'title' => $data->getTitle(),
                    'country' => $country
                ]);
                if (!$tapeTitle) {
                    $tapeTitle = new TapeTitle();
                    $tapeTitle->setTape($tape);
                    $tapeTitle->setCountry($country);
                    $tapeTitle->setTitle($data->getTitle());
                    if ($country) {
                        $tapeTitle->setLanguage($country->getLanguage());
                    }
                }
                $tapeTitle->setObservations($data->getDescription());
                $entityManager->persist($tapeTitle);
                /** @var SearchValue $searchValue */
                $searchValue = $searchValueRepository->findOneBy([
                    'object' => $tape->getObject(),
                    'searchParam' => $data->getTitle()
                ]);
                if (!$searchValue) {
                    $searchValue = new SearchValue();
                    $searchValue->setObject($tape->getObject());
                    $searchValue->setSearchParam($data->getTitle());
                    $entityManager->persist($searchValue);
                }
                $entityManager->flush();
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
                /** @var TapeCertification $tapeCertification */
                $tapeCertification = $entityManager->getRepository(TapeCertification::class)->findOneBy([
                    'tape' => $tape,
                    'country' => $country
                ]);
                if (!$tapeCertification) {
                    $tapeCertification = new TapeCertification();
                    $tapeCertification->setTape($tape);
                    $tapeCertification->setCountry($country);
                }
                $tapeCertification->setCertification($data['certification']);
                $entityManager->persist($tapeCertification);
                $entityManager->flush();
            }
        }
        return $tape;
    }
}