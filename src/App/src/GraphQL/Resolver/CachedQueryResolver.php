<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:25
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\Wrapper\AbstractWrapper;
use Zend\Cache\Pattern\ObjectCache;
use Zend\Cache\PatternFactory;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class CachedQueryResolver
{
    public static function resolve(AbstractAdapter $adapter, AbstractWrapper $wrapper, array $args)
    {

        /** @var ObjectCache $cache */
        $cache = PatternFactory::factory('object', [
            'object'  => $wrapper,
            'storage' => $adapter
        ]);
        return $cache->getData($args);
    }
}