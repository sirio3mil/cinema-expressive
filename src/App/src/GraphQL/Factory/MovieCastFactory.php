<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:25
 */

namespace App\GraphQL\Factory;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Resolver\MovieCastResolver;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieCastFactory
{
    public function __invoke(ContainerInterface $container): MovieCastResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieCastResolver($cacheStorageAdapter, $typeRegistry);
    }
}