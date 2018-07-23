<?php

declare(strict_types=1);

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            App\Alias\MongoDBClient::class => MongoDB\Client::class,
            App\Alias\MongoDBManager::class => MongoDB\Driver\Manager::class,
            App\Alias\EntityManager::class => Doctrine\ORM\EntityManager::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            //App\GraphQL\TypeRegistry::class => App\GraphQL\TypeRegistry::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories'  => [
            Zend\Cache\Storage\Adapter\Memcached::class => App\Factory\MemcachedFactory::class,
            GraphQL\Type\Schema::class => App\Factory\SchemaFactory::class,
            GraphQL\Server\StandardServer::class => App\Factory\StandardServerFactory::class,
            App\GraphQL\TypeRegistry::class => App\Factory\TypeRegistryFactory::class,
            MongoDB\Client::class => \App\Factory\MongoDBClientFactory::class,
            MongoDB\Driver\Manager::class => App\Factory\MongoDBManagerFactory::class,
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class
        ],
    ],
];
