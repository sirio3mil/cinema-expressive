<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 23/07/2018
 * Time: 15:47
 */

namespace App\Factory;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Types\Type;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['zend-db'] ?? [];
        $config = $config['mssql'] ?? [];

        $paths = [
            __DIR__. "/src/App/src/Entity"
        ];
        $isDevMode = true;

        $dbParams = [
            'driver'   => $config['driver'],
            'user'     => $config['username'],
            'password' => $config['password'],
            'dbname'   => $config['database'],
            'host'     => $config['hostname']
        ];

        Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

        $config = Setup::createAnnotationMetadataConfiguration($paths,$isDevMode, null, null, false);

        return EntityManager::create($dbParams, $config);
    }
}