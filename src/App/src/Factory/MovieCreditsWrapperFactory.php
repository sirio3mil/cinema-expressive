<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:25
 */

namespace App\Factory;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\MovieCreditsWrapper;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieCreditsWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieCreditsWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieCreditsWrapper($cacheStorageAdapter, $typeRegistry);
    }
}