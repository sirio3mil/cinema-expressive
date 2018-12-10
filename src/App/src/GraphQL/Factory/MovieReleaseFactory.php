<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:34
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Resolver\MovieReleaseResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieReleaseFactory
{
    public function __invoke(ContainerInterface $container): MovieReleaseResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieReleaseResolver($cacheStorageAdapter, $typeRegistry);
    }
}