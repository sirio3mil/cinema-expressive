<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\Resolver\QueryGetMovieResolver;
use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\QueryGetMovieWrapper;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class QueryType extends AbstractType
{

    public function __construct(TypeRegistry $typeRegistry, AbstractAdapter $cacheStorageAdapter)
    {

        $this->cacheStorageAdapter = $cacheStorageAdapter;

        parent::__construct([
            'fields' => [
                'getMovie' => [
                    'type'    => $typeRegistry->get('movie'),
                    'args'    => [
                        'imdbNumber' => [
                            'type' => Type::int()
                        ]
                    ],
                    'resolve' => function ($source, $args) {
                        return QueryGetMovieResolver::resolve($this, $args);
                    }
                ]
            ]
        ]);
    }
}