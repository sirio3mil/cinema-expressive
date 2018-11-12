<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 13:26
 */

namespace App\Factory;


use MongoDB\Driver\Manager;
use Psr\Container\ContainerInterface;

class MongoDBManagerFactory
{
    public function __invoke(ContainerInterface $container): Manager
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['mongo'] ?? [];

        return new Manager($config['dsn']);
    }
}