<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:00
 */

namespace App\Factory;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\SearchWrapper;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Db\Adapter\Adapter;

class SearchWrapperFactory
{
    public function __invoke(ContainerInterface $container): SearchWrapper
    {
        $adapter = $container->get(Adapter::class);
        $entityManager = $container->get(EntityManager::class);
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new SearchWrapper($adapter, $entityManager, $cacheStorageAdapter, $typeRegistry);
    }
}