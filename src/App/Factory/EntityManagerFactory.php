<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 23/07/2018
 * Time: 15:47
 */

namespace App\Factory;

use App\Logger\Query;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Cache\DefaultCacheFactory;
use Doctrine\ORM\Cache\RegionsConfiguration;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Memcached;
use Psr\Container\ContainerInterface;
use function dirname;
use function sys_get_temp_dir;

class EntityManagerFactory
{
    /**
     * @param $config
     * @return EntityManager
     * @throws ORMException
     * @throws Exception
     */
    public static function createFromConfiguration($config): EntityManager
    {
        $isDevMode = $config['debug'];
        $dbConfig = $config['db'] ?? [];
        $cacheConfig = $config['zend-cache'] ?? [];

        $dbParams = [
            'driver' => $dbConfig['driver'],
            'user' => $dbConfig['username'],
            'password' => $dbConfig['password'],
            'dbname' => $dbConfig['database'],
            'host' => $dbConfig['hostname'],
            'charset' => $dbConfig['charset']
        ];

        Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        $proxyDir = sys_get_temp_dir();
        $config = new Configuration();
        $config->setProxyDir($proxyDir);
        $config->setProxyNamespace('DoctrineProxies');
        $config->setAutoGenerateProxyClasses($isDevMode);

        if (!$isDevMode) {
            $memcached = new Memcached();
            $memcached->addServer($cacheConfig['adapter']['options']['servers'][0], 11211);
            $memcachedCache = new MemcachedCache();
            $memcachedCache->setMemcached($memcached);
            $config->setResultCacheImpl($memcachedCache);
            $phpFileCache = new PhpFileCache($proxyDir);
            $config->setMetadataCacheImpl($phpFileCache);
            $config->setQueryCacheImpl($phpFileCache);
            $config->setSecondLevelCacheEnabled();
            $config->getSecondLevelCacheConfiguration()
                ->setCacheFactory(new DefaultCacheFactory(
                        new RegionsConfiguration(),
                        $phpFileCache
                    )
                );
        } else {
            $config->setSQLLogger(new Query());
        }

        $dirname = dirname(__DIR__, 3);
        $paths = [
            "{$dirname}/src/App/Entity",
            "{$dirname}/vendor/ecodev/graphql-doctrine/src/Annotation"
        ];
        $useSimpleAnnotationReader = false;
        $config->setMetadataDriverImpl($config->newDefaultAnnotationDriver($paths, $useSimpleAnnotationReader));

        return EntityManager::create($dbParams, $config);
    }

    /**
     * @param ContainerInterface $container
     * @return EntityManager
     * @throws Exception
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->has('config') ? $container->get('config') : [];
        return self::createFromConfiguration($config);
    }
}
