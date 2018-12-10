<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:36
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Resolver\MovieKeywordResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieKeywordFactory
{
    public function __invoke(ContainerInterface $container): MovieKeywordResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieKeywordResolver($cacheStorageAdapter, $typeRegistry);
    }
}