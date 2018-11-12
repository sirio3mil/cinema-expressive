<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 13:14
 */

namespace App\Factory;


use MongoDB\Client;
use Psr\Container\ContainerInterface;

class MongoDBClientFactory
{
    public function __invoke(ContainerInterface $container): Client
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['mongo'] ?? [];

        return new Client($config['dsn']);
    }
}