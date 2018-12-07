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
use Psr\Container\ContainerInterface;

class Mutation extends ObjectType
{
    public function __construct(ContainerInterface $container)
    {

        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        parent::__construct([
            'fields' => [
                'editTapeUser' => [
                    'args' => [
                        'userId' => Type::nonNull(Type::int()),
                        'imdbNumbers' => Type::listOf(Type::int()),
                        'tapeIds' => Type::listOf(Type::int()),
                        'tapeUserStatusId' => Type::nonNull(Type::int()),
                        'placeId' => Type::int()
                    ],
                    'type' => new ObjectType([
                        'name' => 'EditTapeUserOutput',
                        'fields' => [
                            'tapesUser' => Type::listOf($typeRegistry->get('tapeUser'))
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($container) {
                        return EditTapeUserResolver::resolve($container, $args);
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
                    'resolve' => function ($source, $args) use ($container) {
                        return ImportImdbMovieResolver::resolve($container, $args);
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
                            'episodes' => Type::listOf($typeRegistry->get('importedEpisode'))
                        ]
                    ]),
                    'resolve' => function ($source, $args) use ($container) {
                        return ImportImdbEpisodeListResolver::resolve($container, $args);
                    }
                ]
            ]
        ]);
    }
}