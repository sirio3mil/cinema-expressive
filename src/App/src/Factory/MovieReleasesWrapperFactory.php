<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:34
 */

namespace App\Factory;


use App\GraphQL\Wrapper\MovieReleasesWrapper;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieReleasesWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieReleasesWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieReleasesWrapper($cacheStorageAdapter, $typeRegistry);
    }
}