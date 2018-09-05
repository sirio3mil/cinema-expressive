<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\GraphQL\Type;


use App\GraphQL\Resolver\EditTapeUserResolver;
use App\GraphQL\Resolver\ImportImdbEpisodeListResolver;
use App\GraphQL\Resolver\ImportImdbMovieResolver;
use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {

        parent::__construct([
            'fields' => [
                'editTapeUser' => [
                    'args' => [
                        'userId' => Type::nonNull(Type::int()),
                        'imdbNumber' => Type::int(),
                        'tapeId' => Type::int(),
                        'tapeUserStatusId' => Type::nonNull(Type::int()),
                        'place' => Type::int()
                    ],
                    'type' => new ObjectType([
                        'name' => 'EditTapeUserOutput',
                        'fields' => [
                            'tapeUserId' => Type::int(),
                            'tapeUserHistoryId' => Type::int()
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        return EditTapeUserResolver::resolve($typeRegistry, $args);
                    }
                ],
                'importImdbMovie' => [
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int())
                    ],
                    'type' => new ObjectType([
                        'name' => 'ImportImdbMovieOutput',
                        'fields' => [
                            'tapeId' => Type::int()
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        return ImportImdbMovieResolver::resolve($typeRegistry, $args);
                    }
                ],
                'importImdbEpisodeList' => [
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                        'seasonNumber' => Type::nonNull(Type::int())
                    ],
                    'type' => new ObjectType([
                        'name' => 'ImportImdbEpisodeListOutput',
                        'fields' => [
                            'episodes' => Type::listOf($typeRegistry->get('importedEpisode')),
                            'tvShowId' => Type::int()
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        return ImportImdbEpisodeListResolver::resolve($typeRegistry, $args);
                    }
                ]
            ]
        ]);
    }
}