<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\GraphQL\Type;

use App\Entity\ImdbNumber;
use App\Entity\Tape;
use App\GraphQL\Resolver\CachedDocumentNodeResolver;
use App\GraphQL\TypeRegistry;
use App\Alias\MongoDBClient;
use Doctrine\ORM\EntityManager;
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
                        /** @var ImdbNumber $imdbNumber */
                        $imdbNumber = $entityManager->getRepository(ImdbNumber::class)->findOneBy([
                            "imdbNumber" => $args['imdbNumber']
                        ]);
                        if($imdbNumber){
                            /** @var Tape $tape */
                            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                                "objectId" => $imdbNumber->getObjectId()
                            ]);
                        }
                        else{
                            $tape = new Tape();
                            $tape->setOriginalTitle($result->data['imdbMovieDetails']['title']);
                            $entityManager->persist($tape);
                            $entityManager->flush();
                            $imdbNumber = new ImdbNumber();
                            $imdbNumber->setImdbNumber($args['imdbNumber']);
                            $imdbNumber->setObjectId($tape->getObjectId());
                            $entityManager->persist($imdbNumber);
                            $entityManager->flush();
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