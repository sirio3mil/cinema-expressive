<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\GraphQL\Type;

use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\ImdbNumber;
use App\Entity\GlobalUniqueObject;
use App\Entity\Language;
use App\Entity\People;
use App\Entity\PeopleAlias;
use App\Entity\PeopleAliasTape;
use App\Entity\Role;
use App\Entity\RowType;
use App\Entity\Sound;
use App\Entity\Tape;
use App\Entity\TapeDetail;
use App\Entity\TapePeopleRole;
use App\Entity\TapePeopleRoleCharacter;
use App\Entity\TvShow;
use App\Entity\TvShowChapter;
use App\GraphQL\Resolver\CachedDocumentNodeResolver;
use App\GraphQL\TypeRegistry;
use App\Alias\MongoDBClient;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Zend\Debug\Debug;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Interop\Container\ContainerInterface;
use MongoDB\Collection;

class MutationType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {

        parent::__construct([
            'fields' => [
                'importImdbMovie' => [
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int())
                    ],
                    'type' => new ObjectType([
                        'name' => 'ImportImdbMovieOutput',
                        'fields' => [
                            'title' => Type::string(),
                            'imdbNumber' => Type::int()
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        $source = CachedDocumentNodeResolver::resolve($typeRegistry->getCacheStorageAdapter(),
                            'queries/graphql/FullMovie.graphql');
                        /** @var ExecutionResult $gqQueryResult */
                        $gqQueryResult = GraphQL::executeQuery(
                            $typeRegistry->getSchema(),
                            $source,
                            null,
                            null,
                            [
                                "imdbNumber" => $args['imdbNumber']
                            ]
                        );
                        $date = new \DateTime();
                        /** @var ContainerInterface $container */
                        $container = $typeRegistry->getContainer();
                        /** @var Collection $collection */
                        $container->get(MongoDBClient::class)
                            ->cinema
                            ->movies
                            ->findOneAndReplace(
                                [
                                    "imdbMovieDetails.imdbNumber" => $args['imdbNumber']
                                ],
                                array_merge($gqQueryResult->data, ["updated" => $date]),
                                [
                                    "upsert" => true
                                ]
                            );
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
                        $tape->setOriginalTitle($gqQueryResult->data['imdbMovieDetails']['title']);
                        $entityManager->persist($tape);
                        /** @var TapeDetail $tapeDetail */
                        $tapeDetail = $entityManager->getRepository(TapeDetail::class)->findOneBy([
                            "tape" => $tape
                        ]);
                        if (!$tapeDetail) {
                            $tapeDetail = new TapeDetail();
                            $tapeDetail->setTape($tape);
                        }
                        $tapeDetail->setDuration($gqQueryResult->data['imdbMovieDetails']['duration']);
                        $tapeDetail->setYear($gqQueryResult->data['imdbMovieDetails']['year']);
                        $tapeDetail->setScore($gqQueryResult->data['imdbMovieDetails']['score']);
                        $tapeDetail->setVotes($gqQueryResult->data['imdbMovieDetails']['votes']);
                        $tapeDetail->setColor($gqQueryResult->data['imdbMovieDetails']['color']);
                        $tapeDetail->setIsTvShow($gqQueryResult->data['imdbMovieDetails']['isTvShow']);
                        $entityManager->persist($tapeDetail);
                        /** @var ArrayCollection $sounds */
                        $sounds = $tape->getSounds();
                        if ($gqQueryResult->data['imdbMovieDetails']['sounds']) {
                            foreach ($gqQueryResult->data['imdbMovieDetails']['sounds'] as $text) {
                                /** @var Sound $sound */
                                $sound = $entityManager->getRepository(Sound::class)->findOneBy([
                                    "description" => $text
                                ]);
                                if ($sound && !$sounds->contains($sound)) {
                                    $tape->addSound($sound);
                                }
                            }
                        }
                        /** @var ArrayCollection $genres */
                        $genres = $tape->getGenres();
                        if ($gqQueryResult->data['imdbMovieDetails']['genres']) {
                            foreach ($gqQueryResult->data['imdbMovieDetails']['genres'] as $text) {
                                /** @var Genre $genre */
                                $genre = $entityManager->getRepository(Genre::class)->findOneBy([
                                    "name" => $text
                                ]);
                                if ($genre && !$genres->contains($genre)) {
                                    $tape->addGenre($genre);
                                }
                            }
                        }
                        /** @var ArrayCollection $languages */
                        $languages = $tape->getLanguages();
                        if ($gqQueryResult->data['imdbMovieDetails']['languages']) {
                            foreach ($gqQueryResult->data['imdbMovieDetails']['languages'] as $text) {
                                /** @var Language $language */
                                $language = $entityManager->getRepository(Language::class)->findOneBy([
                                    "name" => $text
                                ]);
                                if ($language && !$languages->contains($language)) {
                                    $tape->addLanguage($language);
                                }
                            }
                        }
                        /** @var ArrayCollection $countries */
                        $countries = $tape->getCountries();
                        if ($gqQueryResult->data['imdbMovieDetails']['countries']) {
                            foreach ($gqQueryResult->data['imdbMovieDetails']['countries'] as $text) {
                                /** @var Country $country */
                                $country = $entityManager->getRepository(Country::class)->findOneBy([
                                    "officialName" => $text
                                ]);
                                if ($country && !$countries->contains($country)) {
                                    $tape->addCountry($country);
                                }
                            }
                        }
                        if ($tapeDetail->getIsTvShow()) {
                            /** @var TvShow $tvShow */
                            $tvShow = $entityManager->getRepository(TvShow::class)->findOneBy([
                                "tapeId" => $tape->getTapeId()
                            ]);
                            if (!$tvShow) {
                                $tvShow = new TvShow();
                                $tvShow->setTape($tape);
                            }
                            $entityManager->persist($tvShow);
                        }
                        if ($gqQueryResult->data['imdbMovieDetails']['isEpisode']) {
                            /** @var TvShowChapter $tvShowChapter */
                            $tvShowChapter = $entityManager->getRepository(TvShowChapter::class)->findOneBy([
                                "tapeId" => $tape->getTapeId()
                            ]);
                            if (!$tvShowChapter) {
                                /** @var Query $query */
                                $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
                                $query->setParameters([
                                    'imdbNumber' => $gqQueryResult->data['imdbMovieDetails']['tvShow'],
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
                            $tvShowChapter->setSeason($gqQueryResult->data['imdbMovieDetails']['seasonNumber']);
                            $tvShowChapter->setChapter($gqQueryResult->data['imdbMovieDetails']['episodeNumber']);
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
                        foreach ($dqlQueryResult as $row){
                            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
                        }
                        if ($gqQueryResult->data['imdbMovieCredits']['cast']) {
                            foreach ($gqQueryResult->data['imdbMovieCredits']['cast'] as $person) {
                                /** @var TapePeopleRole $tapePeopleRole */
                                $tapePeopleRole = null;
                                /** @var People $people */
                                $people = null;
                                if (array_key_exists($person['imdbNumber'], $cast)) {
                                    $tapePeopleRole = $cast[$person['imdbNumber']];
                                    $people = $tapePeopleRole->getPeople();
                                }
                                if(!$people) {
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
                                if (!$tapePeopleRole) {
                                    $tapePeopleRole = new TapePeopleRole();
                                    $tapePeopleRole->setTape($tape);
                                    $tapePeopleRole->setRole($castRole);
                                    $tapePeopleRole->setPeople($people);
                                    $entityManager->persist($tapePeopleRole);
                                }
                                $entityManager->flush();
                                if(!empty($person['alias'])) {
                                    /** @var PeopleAlias $peopleAlias */
                                    $peopleAlias = $entityManager->getRepository(PeopleAlias::class)->findOneBy([
                                        "people" => $people,
                                        "alias" => $person['alias']
                                    ]);
                                    if(!$peopleAlias){
                                        $peopleAlias = new PeopleAlias();
                                        $peopleAlias->setPeople($people);
                                        $peopleAlias->setAlias($person['alias']);
                                        $entityManager->persist($peopleAlias);
                                        $entityManager->flush();
                                    }
                                    /** @var PeopleAliasTape $peopleAliasTape */
                                    $peopleAliasTape = $entityManager->getRepository(PeopleAliasTape::class)->findOneBy([
                                        "peopleAlias" => $peopleAlias,
                                        "tape" => $tape
                                    ]);
                                    if(!$peopleAliasTape){
                                        $peopleAliasTape = new PeopleAliasTape();
                                        $peopleAliasTape->setTape($tape);
                                        $peopleAliasTape->setPeopleAlias($peopleAlias);
                                        $entityManager->persist($peopleAliasTape);
                                        $entityManager->flush();
                                    }
                                }
                                if(!empty($person['character'])) {
                                    /** @var TapePeopleRoleCharacter $peopleAliasTape */
                                    $tapePeopleRoleCharacter = $entityManager->getRepository(TapePeopleRoleCharacter::class)->findOneBy([
                                        "tapePeopleRole" => $tapePeopleRole
                                    ]);
                                    if(!$tapePeopleRoleCharacter){
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
                        foreach ($dqlQueryResult as $row){
                            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
                        }
                        if ($gqQueryResult->data['imdbMovieCredits']['directors']) {
                            foreach ($gqQueryResult->data['imdbMovieCredits']['directors'] as $person) {
                                /** @var TapePeopleRole $tapePeopleRole */
                                $tapePeopleRole = null;
                                /** @var People $people */
                                $people = null;
                                if (array_key_exists($person['imdbNumber'], $cast)) {
                                    $tapePeopleRole = $cast[$person['imdbNumber']];
                                    $people = $tapePeopleRole->getPeople();
                                }
                                if(!$people) {
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
                        foreach ($dqlQueryResult as $row){
                            $cast[intval($row['imdbNumber'])] = $row['tapePeopleRole'];
                        }
                        if ($gqQueryResult->data['imdbMovieCredits']['writers']) {
                            foreach ($gqQueryResult->data['imdbMovieCredits']['writers'] as $person) {
                                /** @var TapePeopleRole $tapePeopleRole */
                                $tapePeopleRole = null;
                                /** @var People $people */
                                $people = null;
                                if (array_key_exists($person['imdbNumber'], $cast)) {
                                    $tapePeopleRole = $cast[$person['imdbNumber']];
                                    $people = $tapePeopleRole->getPeople();
                                }
                                if(!$people) {
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
                        return [
                            "title" => $tape->getOriginalTitle(),
                            "imdbNumber" => $imdbNumber->getImdbNumber()
                        ];
                    }
                ]
            ]
        ]);
    }
}