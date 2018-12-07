<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:46
 */

namespace App\Factory;


use App\GraphQL\Wrapper\EpisodeListWrapper;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class EpisodeListWrapperFactory
{
    public function __invoke(ContainerInterface $container): EpisodeListWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new EpisodeListWrapper($cacheStorageAdapter, $typeRegistry);
    }
}