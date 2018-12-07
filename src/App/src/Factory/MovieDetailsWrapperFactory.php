<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:21
 */

namespace App\Factory;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\MovieDetailsWrapper;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieDetailsWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieDetailsWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieDetailsWrapper($cacheStorageAdapter, $typeRegistry);
    }
}