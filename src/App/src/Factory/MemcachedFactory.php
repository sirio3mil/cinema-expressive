<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:26
 */

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Cache\StorageFactory;

class MemcachedFactory
{
    public function __invoke(ContainerInterface $container): Memcached
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['zend-cache'] ?? [];

        return StorageFactory::factory($config);
    }
}