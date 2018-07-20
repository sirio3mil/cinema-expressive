<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\GraphQL\Type;


use App\GraphQL\Resolver\CachedDocumentNodeResolver;
use App\GraphQL\TypeRegistry;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {

        parent::__construct([
            'fields' => [
                'importMovie' => [
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int())
                    ],
                    'type' => new ObjectType([
                        'name' => 'CreateReviewOutput',
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
                        return $result->data['movieDetails'];
                    }
                ]
            ]
        ]);
    }
}