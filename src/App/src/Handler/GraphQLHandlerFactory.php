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
        die('ola');
        /*$cacheAdapter = $container->get(AbstractAdapter::class);*/

        /** @var Memcached $cacheStorageAdapter */
        $cacheStorageAdapter = StorageFactory::factory([
            'adapter' => [
                'name' => 'memcached',
                'options' => [
                    'ttl' => 3600,
                    'namespace' => 'cache_listener',
                    'key_pattern' => null,
                    'readable' => true,
                    'writable' => true,
                    'servers' => ['memcached'],
                ],
            ],
            'plugins' => [
                'exception_handler' => ['throw_exceptions' => false],
            ],
        ]);

        return new GraphQLHandler($cacheStorageAdapter);
    }
}