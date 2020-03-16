<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:26
 */

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Laminas\Cache\Storage\Adapter\Memcached;
use Laminas\Cache\StorageFactory;

class MemcachedFactory
{
    public function __invoke(ContainerInterface $container): Memcached
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['zend-cache'] ?? [];
        /** @var Memcached $storage */
        $storage = StorageFactory::factory($config);
        return $storage;
    }
}
