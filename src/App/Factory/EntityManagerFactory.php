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
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
use Doctrine\Common\Cache\MemcachedCache;
use Psr\Container\ContainerInterface;
use Memcached;

class EntityManagerFactory
{
    /**
     * @param ContainerInterface $container
     * @return EntityManager
     * @throws DBALException
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $isDevMode = $config['debug'];
        $dbConfig = $config['db'] ?? [];
        $cacheConfig = $config['zend-cache'] ?? [];

        $paths = [
            __DIR__ . "/src/App/src/Entity"
        ];

        $dbParams = [
            'driver' => $dbConfig['driver'],
            'user' => $dbConfig['username'],
            'password' => $dbConfig['password'],
            'dbname' => $dbConfig['database'],
            'host' => $dbConfig['hostname'],
            'charset' => $dbConfig['charset']
        ];

        Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

        if (!$isDevMode) {
            $memcached = new Memcached();
            $memcached->addServer($cacheConfig['adapter']['options']['servers'][0], 11211);
            $cacheDriver = new MemcachedCache();
            $cacheDriver->setMemcached($memcached);
        } else {
            $cacheDriver = null;
        }
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, $cacheDriver, false);

        return EntityManager::create($dbParams, $config);
    }
}