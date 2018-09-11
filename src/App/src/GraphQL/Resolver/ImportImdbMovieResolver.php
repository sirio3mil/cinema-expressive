<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:23
 */

namespace App\GraphQL\Resolver;


use App\Alias\MongoDBClient;
use App\GraphQL\TypeRegistry;
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
use App\GraphQL\Wrapper\MovieCertificatesWrapper;
use App\GraphQL\Wrapper\MovieReleasesWrapper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Interop\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\Wrapper\MovieDetailsWrapper;
use App\GraphQL\Wrapper\MovieKeywordsWrapper;
use App\GraphQL\Wrapper\MovieLocationsWrapper;
use App\GraphQL\Wrapper\MovieCreditsWrapper;

class ImportImdbMovieResolver
{
    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {
        /** @var AbstractAdapter $cacheStorageAdapter */
        $cacheStorageAdapter = $typeRegistry->getCacheStorageAdapter();
        /** @var ContainerInterface $container */
        $container = $typeRegistry->getContainer();
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var RowType $tapeRowType */
        $tapeRowType = $entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_TAPE
        ]);
        /** @var Query $query */
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
        $query->setParameters([
            'imdbNumber' => $args['imdbNumber'],
            'rowType' => $tapeRowType
        ]);
        /** @var ImdbNumber $imdbNumber */
        $imdbNumber = $query->getOneOrNullResult();
        if ($imdbNumber) {
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                "object" => $imdbNumber->getObject()
            ]);
            if (!$tape) {
                $tape = new Tape();
                $tape->setObject($imdbNumber->getObject());
            }
        } else {
            $object = new GlobalUniqueObject();
            $object->setRowType($tapeRowType);
            $entityManager->persist($object);
            $tape = new Tape();
            $tape->setObject($object);
            $imdbNumber = new ImdbNumber();
            $imdbNumber->setImdbNumber($args['imdbNumber']);
            $imdbNumber->setObject($tape->getObject());
            $entityManager->persist($imdbNumber);
        }
        /** @var array $imdbMovieDetails */
        $imdbMovieDetails = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieDetailsWrapper(), $args);
        $tape->setOriginalTitle($imdbMovieDetails['title']);
        $entityManager->persist($tape);
        /** @var SearchValue $searchValue */
        $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
            'object' => $tape->getObject(),
            'searchParam' => $imdbMovieDetails['title']
        ]);
        if(!$searchValue){
            $searchValue = new SearchValue();
            $searchValue->setObject($tape->getObject());
            $searchValue->setSearchParam($imdbMovieDetails['title']);
            $entityManager->persist($searchValue);
        }
        /** @var TapeDetail $tapeDetail */
        $tapeDetail = $entityManager->getRepository(TapeDetail::class)->findOneBy([
            "tape" => $tape
        ]);
        if (!$tapeDetail) {
            $tapeDetail = new TapeDetail();
            $tapeDetail->setTape($tape);
        }
        $tapeDetail->setDuration($imdbMovieDetails['duration']);
        $tapeDetail->setYear($imdbMovieDetails['year']);
        $tapeDetail->setScore($imdbMovieDetails['score']);
        $tapeDetail->setVotes($imdbMovieDetails['votes']);
        $tapeDetail->setColor($imdbMovieDetails['color']);
        $tapeDetail->setIsTvShow($imdbMovieDetails['isTvShow']);
        $entityManager->persist($tapeDetail);
        /** @var ArrayCollection $sounds */
        $sounds = $tape->getSounds();
        if ($imdbMovieDetails['sounds']) {
            foreach ($imdbMovieDetails['sounds'] as $text) {
                /** @var Sound $sound */
                $sound = $entityManager->getRepository(Sound::class)->findOneBy([
                    "description" => $text
                ]);
                if ($sound && !$sounds->contains($sound)) {
                    $tape->addSound($sound);
                }
            }
        }
        if ($imdbMovieDetails['genres']) {
            /** @var ArrayCollection $genres */
            $genres = $tape->getGenres();
            foreach ($imdbMovieDetails['genres'] as $text) {
                /** @var Genre $genre */
                $genre = $entityManager->getRepository(Genre::class)->findOneBy([
                    "name" => $text
                ]);
                if ($genre && !$genres->contains($genre)) {
                    $tape->addGenre($genre);
                }
            }
        }
        if ($imdbMovieDetails['languages']) {
            /** @var ArrayCollection $languages */
            $languages = $tape->getLanguages();
            foreach ($imdbMovieDetails['languages'] as $text) {
                /** @var Language $language */
                $language = $entityManager->getRepository(Language::class)->findOneBy([
                    "name" => $text
                ]);
                if ($language && !$languages->contains($language)) {
                    $tape->addLanguage($language);
                }
            }
        }
        if ($imdbMovieDetails['countries']) {
            /** @var ArrayCollection $countries */
            $countries = $tape->getCountries();
            foreach ($imdbMovieDetails['countries'] as $text) {
                /** @var Country $country */
                $country = $entityManager->getRepository(Country::class)->findOneBy([
                    "officialName" => $text
                ]);
                if ($country && !$countries->contains($country)) {
                    $tape->addCountry($country);
                }
            }
        }
        $entityManager->flush();
        /** @var array $imdbMovieKeywords */
        $imdbMovieKeywords = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieKeywordsWrapper(), $args);
        if ($imdbMovieKeywords && $imdbMovieKeywords['keywords']) {
            /** @var ArrayCollection $tags */
            $tags = $tape->getTags();
            foreach ($imdbMovieKeywords['keywords'] as $data) {
                /** @var Tag $tag */
                $tag = $entityManager->getRepository(Tag::class)->findOneBy([
                    'keyword' => $data['keyword']
                ]);
                if (!$tag) {
                    $tag = new Tag();
                    $tag->setKeyword($data['keyword']);
                    $entityManager->persist($tag);
                }
                if ($tag && !$tags->contains($tag)) {
                    $tape->addTag($tag);
                }
            }
            $entityManager->flush();
        }
        /** @var array $imdbMovieLocations */
        $imdbMovieLocations = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieLocationsWrapper(), $args);
        if ($imdbMovieLocations) {
            /** @var ArrayCollection $locations */
            $locations = $tape->getLocations();
            foreach ($imdbMovieLocations as $data) {
                /** @var Location $location */
                $location = $entityManager->getRepository(Location::class)->findOneBy([
                    'place' => $data['location']
                ]);
                if (!$location) {
                    $location = new Location();
                    $location->setPlace($data['location']);
                    $entityManager->persist($location);
                }
                if ($locations && !$locations->contains($location)) {
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
                $tvShow->setTape($tape);
                $entityManager->persist($tvShow);
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
                $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
                $query->setParameters([
                    'imdbNumber' => $imdbMovieDetails['tvShow'],
                    'rowType' => $tapeRowType
                ]);
                /** @var ImdbNumber $tvShowImdbNumber */
                $tvShowImdbNumber = $query->getSingleResult();
                /** @var Query $query */
                $query = $entityManager->createQuery('SELECT tv FROM App\Entity\TvShow tv JOIN tv.tape t WHERE t.object = :object');
                $query->setParameters([
                    'object' => $tvShowImdbNumber->getObject()
                ]);
                /** @var TvShow $tvShow */
                $tvShow = $query->getSingleResult();
                $tvShowChapter = new TvShowChapter();
                $tvShowChapter->setTape($tape);
                $tvShowChapter->setTvShow($tvShow);
            }
            $tvShowChapter->setSeason($imdbMovieDetails['seasonNumber']);
            $tvShowChapter->setChapter($imdbMovieDetails['episodeNumber']);
            $entityManager->persist($tvShowChapter);
        }
        $entityManager->flush();
        /** @var Role $castRole */
        $castRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_CAST
        ]);
        /** @var RowType $peopleRowType */
        $peopleRowType = $entityManager->getRepository(RowType::class)->findOneBy([
            "rowTypeId" => RowType::ROW_TYPE_PEOPLE
        ]);
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
            'role' => $castRole,
            'tape' => $tape
        ]);
        /** @var array $result */
        $dqlQueryResult = $query->getResult();
        $cast = [];
        foreach ($dqlQueryResult as $row) {
            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
        }
        /** @var array $imdbMovieCredits */
        $imdbMovieCredits = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieCreditsWrapper(), $args);
        if ($imdbMovieCredits['cast']) {
            foreach ($imdbMovieCredits['cast'] as $person) {
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person['imdbNumber'], $cast)) {
                    $tapePeopleRole = $cast[$person['imdbNumber']];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    /** @var Query $query */
                    $query = $entityManager->createQuery('
                                        SELECT p 
                                        FROM App\Entity\People p 
                                        JOIN App\Entity\ImdbNumber i 
                                          WITH i.object = p.object 
                                        WHERE i.imdbNumber = :imdbNumber
                                    ');
                    $query->setParameters([
                        'imdbNumber' => $person['imdbNumber']
                    ]);
                    $people = $query->getOneOrNullResult();
                }
                if (!$people) {
                    $object = new GlobalUniqueObject();
                    $object->setRowType($peopleRowType);
                    $entityManager->persist($object);
                    $people = new People();
                    $people->setObject($object);
                    $people->setFullName($person['fullName']);
                    $entityManager->persist($people);
                    $imdbNumber = new ImdbNumber();
                    $imdbNumber->setImdbNumber($person['imdbNumber']);
                    $imdbNumber->setObject($object);
                    $entityManager->persist($imdbNumber);
                }
                /** @var SearchValue $searchValue */
                $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
                    'object' => $people->getObject(),
                    'searchParam' => $person['fullName']
                ]);
                if(!$searchValue){
                    $searchValue = new SearchValue();
                    $searchValue->setObject($people->getObject());
                    $searchValue->setSearchParam($person['fullName']);
                    $entityManager->persist($searchValue);
                }
                if (!$tapePeopleRole) {
                    $tapePeopleRole = new TapePeopleRole();
                    $tapePeopleRole->setTape($tape);
                    $tapePeopleRole->setRole($castRole);
                    $tapePeopleRole->setPeople($people);
                    $entityManager->persist($tapePeopleRole);
                }
                $entityManager->flush();
                if (!empty($person['alias'])) {
                    /** @var PeopleAlias $peopleAlias */
                    $peopleAlias = $entityManager->getRepository(PeopleAlias::class)->findOneBy([
                        "people" => $people,
                        "alias" => $person['alias']
                    ]);
                    if (!$peopleAlias) {
                        $peopleAlias = new PeopleAlias();
                        $peopleAlias->setPeople($people);
                        $peopleAlias->setAlias($person['alias']);
                        $entityManager->persist($peopleAlias);
                        $entityManager->flush();
                    }
                    /** @var SearchValue $searchValue */
                    $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
                        'object' => $people->getObject(),
                        'searchParam' => $person['alias']
                    ]);
                    if(!$searchValue){
                        $searchValue = new SearchValue();
                        $searchValue->setObject($people->getObject());
                        $searchValue->setSearchParam($person['alias']);
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
                if (!empty($person['character'])) {
                    /** @var TapePeopleRoleCharacter $peopleAliasTape */
                    $tapePeopleRoleCharacter = $entityManager->getRepository(TapePeopleRoleCharacter::class)->findOneBy([
                        "tapePeopleRole" => $tapePeopleRole
                    ]);
                    if (!$tapePeopleRoleCharacter) {
                        $tapePeopleRoleCharacter = new TapePeopleRoleCharacter();
                        $tapePeopleRoleCharacter->setTapePeopleRole($tapePeopleRole);
                    }
                    $tapePeopleRoleCharacter->setCharacter($person['character']);
                    $entityManager->persist($tapePeopleRoleCharacter);
                    $entityManager->flush();
                }
            }
        }
        /** @var Role $directorRole */
        $directorRole = $entityManager->getRepository(Role::class)->findOneBy([
            "roleId" => ROLE::ROLE_DIRECTOR
        ]);
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
            'role' => $directorRole,
            'tape' => $tape
        ]);
        /** @var array $result */
        $dqlQueryResult = $query->getResult();
        $cast = [];
        foreach ($dqlQueryResult as $row) {
            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
        }
        if ($imdbMovieCredits['directors']) {
            foreach ($imdbMovieCredits['directors'] as $person) {
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person['imdbNumber'], $cast)) {
                    $tapePeopleRole = $cast[$person['imdbNumber']];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    /** @var Query $query */
                    $query = $entityManager->createQuery('
                                        SELECT p 
                                        FROM App\Entity\People p 
                                        JOIN App\Entity\ImdbNumber i 
                                          WITH i.object = p.object 
                                        WHERE i.imdbNumber = :imdbNumber
                                    ');
                    $query->setParameters([
                        'imdbNumber' => $person['imdbNumber']
                    ]);
                    $people = $query->getOneOrNullResult();
                }
                if (!$people) {
                    $object = new GlobalUniqueObject();
                    $object->setRowType($peopleRowType);
                    $entityManager->persist($object);
                    $people = new People();
                    $people->setObject($object);
                    $people->setFullName($person['fullName']);
                    $entityManager->persist($people);
                    $imdbNumber = new ImdbNumber();
                    $imdbNumber->setImdbNumber($person['imdbNumber']);
                    $imdbNumber->setObject($object);
                    $entityManager->persist($imdbNumber);
                }
                /** @var SearchValue $searchValue */
                $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
                    'object' => $people->getObject(),
                    'searchParam' => $person['fullName']
                ]);
                if(!$searchValue){
                    $searchValue = new SearchValue();
                    $searchValue->setObject($people->getObject());
                    $searchValue->setSearchParam($person['fullName']);
                    $entityManager->persist($searchValue);
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
            'role' => $writerRole,
            'tape' => $tape
        ]);
        /** @var array $result */
        $dqlQueryResult = $query->getResult();
        $cast = [];
        foreach ($dqlQueryResult as $row) {
            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
        }
        if ($imdbMovieCredits['writers']) {
            foreach ($imdbMovieCredits['writers'] as $person) {
                /** @var TapePeopleRole $tapePeopleRole */
                $tapePeopleRole = null;
                /** @var People $people */
                $people = null;
                if (array_key_exists($person['imdbNumber'], $cast)) {
                    $tapePeopleRole = $cast[$person['imdbNumber']];
                    $people = $tapePeopleRole->getPeople();
                }
                if (!$people) {
                    /** @var Query $query */
                    $query = $entityManager->createQuery('
                                        SELECT p 
                                        FROM App\Entity\People p 
                                        JOIN App\Entity\ImdbNumber i 
                                          WITH i.object = p.object 
                                        WHERE i.imdbNumber = :imdbNumber
                                    ');
                    $query->setParameters([
                        'imdbNumber' => $person['imdbNumber']
                    ]);
                    $people = $query->getOneOrNullResult();
                }
                if (!$people) {
                    $object = new GlobalUniqueObject();
                    $object->setRowType($peopleRowType);
                    $entityManager->persist($object);
                    $people = new People();
                    $people->setObject($object);
                    $people->setFullName($person['fullName']);
                    $entityManager->persist($people);
                    $imdbNumber = new ImdbNumber();
                    $imdbNumber->setImdbNumber($person['imdbNumber']);
                    $imdbNumber->setObject($object);
                    $entityManager->persist($imdbNumber);
                }
                /** @var SearchValue $searchValue */
                $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
                    'object' => $people->getObject(),
                    'searchParam' => $person['fullName']
                ]);
                if(!$searchValue){
                    $searchValue = new SearchValue();
                    $searchValue->setObject($people->getObject());
                    $searchValue->setSearchParam($person['fullName']);
                    $entityManager->persist($searchValue);
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
        $imdbMovieReleases = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieReleasesWrapper(), $args);
        if ($imdbMovieReleases['dates']) {
            foreach ($imdbMovieReleases['dates'] as $data) {
                /** @var Country $country */
                if ($data['country']) {
                    $country = $entityManager->getRepository(Country::class)->findOneBy([
                        'officialName' => $data['country']
                    ]);
                } else {
                    $country = null;
                }
                $date = \DateTime::createFromFormat("Y-m-d", $data['date']);
                /** @var Premiere $premiere */
                $premiere = $entityManager->getRepository(Premiere::class)->findOneBy([
                    'tape' => $tape,
                    'date' => $date,
                    'country' => $country
                ]);
                if (!$premiere) {
                    $premiere = new Premiere();
                    $premiere->setTape($tape);
                    $premiere->setDate($date);
                    $premiere->setCountry($country);
                    $entityManager->persist($premiere);
                    $entityManager->flush();
                }
                if ($data['details']) {
                    foreach ($data['details'] as $detail) {
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
        if ($imdbMovieReleases['titles']) {
            foreach ($imdbMovieReleases['titles'] as $data) {
                /** @var Country $country */
                if ($data['country']) {
                    $country = $entityManager->getRepository(Country::class)->findOneBy([
                        'officialName' => $data['country']
                    ]);
                } else {
                    $country = null;
                }
                /** @var TapeTitle $tapeTitle */
                $tapeTitle = $entityManager->getRepository(TapeTitle::class)->findOneBy([
                    'tape' => $tape,
                    'title' => $data['title'],
                    'country' => $country
                ]);
                if (!$tapeTitle) {
                    $tapeTitle = new TapeTitle();
                    $tapeTitle->setTape($tape);
                    $tapeTitle->setCountry($country);
                    $tapeTitle->setTitle($data['title']);
                    if ($country) {
                        $tapeTitle->setLanguage($country->getLanguage());
                    }
                }
                $tapeTitle->setObservations($data['description']);
                $entityManager->persist($tapeTitle);
                /** @var SearchValue $searchValue */
                $searchValue = $entityManager->getRepository(SearchValue::class)->findOneBy([
                    'object' => $tape->getObject(),
                    'searchParam' => $data['title']
                ]);
                if(!$searchValue){
                    $searchValue = new SearchValue();
                    $searchValue->setObject($tape->getObject());
                    $searchValue->setSearchParam($data['title']);
                    $entityManager->persist($searchValue);
                }
                $entityManager->flush();
            }
        }
        /** @var array $imdbMovieCertifications */
        $imdbMovieCertifications = CachedQueryResolver::resolve($cacheStorageAdapter, new MovieCertificatesWrapper(), $args);
        if ($imdbMovieCertifications) {
            foreach ($imdbMovieCertifications as $data) {
                /** @var Country $country */
                $country = $entityManager->getRepository(Country::class)->findOneBy([
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
        return [
            "tapeId" => $tape->getTapeId()
        ];
    }
}