<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\Resolver\QueryResolver;
use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\QueryWrapper;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class QueryType extends AbstractType
{

    public function __construct(TypeRegistry $typeRegistry, AbstractAdapter $cacheStorageAdapter)
    {

        $this->typeRegistry = $typeRegistry;
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->wrapper = new QueryWrapper();

        parent::__construct([
            'fields' => [
                'getMovie' => [
                    'type'    => $this->typeRegistry->get('movie'),
                    'args'    => [
                        'imdbNumber' => [
                            'type' => Type::int()
                        ]
                    ],
                    'resolve' => function ($source, $args) {
                        return QueryResolver::resolve($this, $args);
                    }
                ]
            ]
        ]);
    }
}