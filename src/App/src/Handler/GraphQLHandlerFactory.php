<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 17:24
 */

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Cache\StorageFactory;

class GraphQLHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['zend-cache'] ?? [];

        /** @var Memcached $cacheStorageAdapter */
        $cacheStorageAdapter = StorageFactory::factory($config);

        return new GraphQLHandler($cacheStorageAdapter);
    }
}