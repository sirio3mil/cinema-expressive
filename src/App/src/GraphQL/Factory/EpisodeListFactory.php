<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:46
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Resolver\EpisodeListResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class EpisodeListFactory
{
    public function __invoke(ContainerInterface $container): EpisodeListResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new EpisodeListResolver($cacheStorageAdapter, $typeRegistry);
    }
}