<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:36
 */

namespace App\Factory;


use App\GraphQL\Wrapper\MovieKeywordsWrapper;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieKeywordsWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieKeywordsWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieKeywordsWrapper($cacheStorageAdapter, $typeRegistry);
    }
}