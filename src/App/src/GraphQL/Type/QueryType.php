<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\Resolver\CachedQueryResolver;
use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\QueryGetMovieWrapper;
use App\GraphQL\Wrapper\QueryGetEpisodeListWrapper;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class QueryType extends ObjectType
{

    public function __construct(TypeRegistry $typeRegistry, AbstractAdapter $cacheStorageAdapter)
    {

        parent::__construct([
            'fields' => [
                'getMovie' => [
                    'type'    => $typeRegistry->get('movie'),
                    'args'    => [
                        'imdbNumber' => Type::int()
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new QueryGetMovieWrapper(), $args);
                    }
                ],
                'getEpisodeList' => [
                    'type'    => Type::listOf($typeRegistry->get('episode')),
                    'args'    => [
                        'imdbNumber' => Type::int(),
                        'seasonNumber' => Type::int()
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new QueryGetEpisodeListWrapper(), $args);
                    }
                ]
            ]
        ]);
    }
}