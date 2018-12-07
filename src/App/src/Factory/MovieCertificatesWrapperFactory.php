<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:44
 */

namespace App\Factory;


use App\GraphQL\Wrapper\MovieCertificatesWrapper;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MovieCertificatesWrapperFactory
{
    public function __invoke(ContainerInterface $container): MovieCertificatesWrapper
    {
        $cacheStorageAdapter = $container->get(Memcached::class);
        $typeRegistry = $container->get(TypeRegistry::class);
        return new MovieCertificatesWrapper($cacheStorageAdapter, $typeRegistry);
    }
}