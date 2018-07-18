<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\TypeRegistry;
use App\Wrapper\QueryWrapper;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Pattern\ClassCache;
use Zend\Cache\PatternFactory;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class QueryType extends ObjectType
{
    public function __construct(TypeRegistry $types, AbstractAdapter $cacheStorageAdapter)
    {
        parent::__construct([
            'fields' => [
                'getMovie' => [
                    'type' => $types->get('movie'),
                    'args' => [
                        'imdbNumber' => [
                            'type' => Type::int()
                        ]
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        /** @var QueryWrapper $queryWrapper */
                        $queryWrapper = new QueryWrapper();
                        /** @var ClassCache $wrapper */
                        $wrapper = PatternFactory::factory('object', [
                            'object' => $queryWrapper,
                            'storage' => $cacheStorageAdapter
                        ]);
                        return $wrapper->getData($args['imdbNumber']);
                    }
                ]
            ]
        ]);
    }
}