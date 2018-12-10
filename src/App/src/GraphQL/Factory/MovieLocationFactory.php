<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:39
 */

namespace App\GraphQL\Factory;

use App\GraphQL\TypeRegistry;
use App\GraphQL\Resolver\MovieLocationResolver;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieLocationFactory
{
    public function __invoke(ContainerInterface $container): MovieLocationResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieLocationResolver($cacheStorageAdapter, $typeRegistry);
    }
}