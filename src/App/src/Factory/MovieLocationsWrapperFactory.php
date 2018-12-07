<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:39
 */

namespace App\Factory;

use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\MovieLocationsWrapper;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieLocationsWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieLocationsWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieLocationsWrapper($cacheStorageAdapter, $typeRegistry);
    }
}