<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:25
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\Type\AbstractType;
use Zend\Cache\Pattern\ClassCache;
use Zend\Cache\PatternFactory;

class QueryResolver
{
    public static function resolve(AbstractType $objectType, array $args)
    {

        /** @var ClassCache $wrapper */
        $wrapper = PatternFactory::factory('object', [
            'object'  => $objectType->getWrapper(),
            'storage' => $objectType->getCacheStorageAdapter()
        ]);
        return $wrapper->getData($args);
    }
}