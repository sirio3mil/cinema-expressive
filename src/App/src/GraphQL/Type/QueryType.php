<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Zend\Cache\PatternFactory;

class QueryType extends ObjectType
{
    public function __construct(TypeRegistry $types)
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
                    'resolve' => function ($source, $args) {
                        $wrapper = PatternFactory::factory('class', [
                            'class'   => 'App\Wrapper\QueryWrapper',
                            'storage' => 'memcached',
                            'cache_output' => true
                        ]);
                        return $wrapper->call("getData", [$args['imdbNumber']]);
                    }
                ]
            ]
        ]);
    }
}