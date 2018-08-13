<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\GraphQL\Type;

use App\Entity\ImdbNumber;
use App\Entity\GlobalUniqueObject;
use App\Entity\RowType;
use App\Entity\Sound;
use App\Entity\Tape;
use App\Entity\TapeDetail;
use App\GraphQL\Resolver\CachedDocumentNodeResolver;
use App\GraphQL\TypeRegistry;
use App\Alias\MongoDBClient;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
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
                        /** @var ExecutionResult $result */
                        $result = GraphQL::executeQuery(
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
                                array_merge($result->data, ["updated" => $date]),
                                [
                                    "upsert" => true
                                ]
                            );
                        /** @var EntityManager $entityManager */
                        $entityManager = $container->get(EntityManager::class);
                        /** @var RowType $rowType */
                        $rowType = $entityManager->getRepository(RowType::class)->findOneBy([
                            "rowTypeId" => RowType::ROW_TYPE_TAPE
                        ]);
                        /** @var Query $query */
                        $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
                        $query->setParameters([
                            'imdbNumber' => $args['imdbNumber'],
                            'rowType' => $rowType
                        ]);
                        /** @var ImdbNumber $imdbNumber */
                        $imdbNumber = $query->getOneOrNullResult();
                        if($imdbNumber){
                            /** @var Tape $tape */
                            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                                "object" => $imdbNumber->getObject()
                            ]);
                        }
                        else{
                            $object = new GlobalUniqueObject();
                            $object->setRowType($rowType);
                            $entityManager->persist($object);
                            $tape = new Tape();
                            $tape->setObject($object);
                            $imdbNumber = new ImdbNumber();
                            $imdbNumber->setImdbNumber($args['imdbNumber']);
                            $imdbNumber->setObject($tape->getObject());
                            $entityManager->persist($imdbNumber);
                        }
                        $tape->setOriginalTitle($result->data['imdbMovieDetails']['title']);
                        $entityManager->persist($tape);
                        /** @var TapeDetail $tapeDetail */
                        $tapeDetail = $entityManager->getRepository(TapeDetail::class)->findOneBy([
                            "tape" => $tape
                        ]);
                        if(!$tapeDetail){
                            $tapeDetail = new TapeDetail();
                            $tapeDetail->setTape($tape);
                        }
                        $tapeDetail->setDuration($result->data['imdbMovieDetails']['duration']);
                        $tapeDetail->setYear($result->data['imdbMovieDetails']['year']);
                        $tapeDetail->setScore($result->data['imdbMovieDetails']['score']);
                        $tapeDetail->setVotes($result->data['imdbMovieDetails']['votes']);
                        $tapeDetail->setColor($result->data['imdbMovieDetails']['color']);
                        /** @var Sound[] $sounds */
                        $sounds = $tape->getSounds();
                        if($result->data['imdbMovieDetails']['sounds']){
                            foreach ($result->data['imdbMovieDetails']['sounds'] as $description){
                                /** @var Sound $sound */
                                $sound = $entityManager->getRepository(Sound::class)->findOneBy([
                                    "description" => $description
                                ]);
                                if(!in_array($sound, $sounds)){
                                    $tape->addSound($sound);
                                }
                            }
                        }
                        $tapeDetail->setTvShow($result->data['imdbMovieDetails']['isTvShow']);
                        $entityManager->persist($tapeDetail);
                        $entityManager->flush();
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