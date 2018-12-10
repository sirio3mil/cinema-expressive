<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:44
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Resolver\MovieCertificateResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieCertificateFactory
{
    public function __invoke(ContainerInterface $container): MovieCertificateResolver
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieCertificateResolver($cacheStorageAdapter, $typeRegistry);
    }
}