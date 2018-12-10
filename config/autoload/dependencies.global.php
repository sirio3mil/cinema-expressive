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
            App\GraphQL\TypeRegistry::class => App\GraphQL\TypeRegistry::class,
            ImdbScraper\Mapper\HomeMapper::class => \mdbScraper\Mapper\HomeMapper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories'  => [
            Zend\Cache\Storage\Adapter\Memcached::class => App\Factory\MemcachedFactory::class,
            GraphQL\Type\Schema::class => App\Factory\SchemaFactory::class,
            GraphQL\Server\StandardServer::class => App\Factory\StandardServerFactory::class,
            App\GraphQL\Type\Query::class => App\Factory\QueryFactory::class,
            App\GraphQL\Type\Mutation::class => App\Factory\MutationFactory::class,
            App\GraphQL\Wrapper\MovieCreditsWrapper::class => App\Factory\MovieCreditsWrapperFactory::class,
            App\GraphQL\Wrapper\MovieReleasesWrapper::class => App\Factory\MovieCreditsWrapperFactory::class,
            App\GraphQL\Wrapper\MovieKeywordsWrapper::class => App\Factory\MovieKeywordsWrapperFactory::class,
            App\GraphQL\Wrapper\MovieLocationsWrapper::class => App\Factory\MovieLocationsWrapperFactory::class,
            App\GraphQL\Wrapper\MovieCertificatesWrapper::class => App\Factory\MovieCertificatesWrapperFactory::class,
            App\GraphQL\Wrapper\EpisodeListWrapper::class => App\Factory\EpisodeListWrapperFactory::class,
            App\GraphQL\Resolver\SearchResolver::class => App\GraphQL\Factory\SearchFactory::class,
            App\GraphQL\Resolver\MovieDetailResolver::class => App\GraphQL\Factory\MovieDetailFactory::class,
            MongoDB\Client::class => App\Factory\MongoDBClientFactory::class,
            MongoDB\Driver\Manager::class => App\Factory\MongoDBManagerFactory::class,
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class
        ],
    ],
];
