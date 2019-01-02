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
            DateTime::class => App\GraphQL\Type\DateTimeType::class,
            App\GraphQL\Type\SearchResultType::class => App\GraphQL\Type\SearchResultType::class,
            App\GraphQL\Type\ImportedEpisodeType::class => App\GraphQL\Type\ImportedEpisodeType::class,
            App\GraphQL\Type\ImportImdbMovieOutputType::class => App\GraphQL\Type\ImportImdbMovieOutputType::class,
            ImdbScraper\Mapper\HomeMapper::class => ImdbScraper\Mapper\HomeMapper::class,
            ImdbScraper\Mapper\KeywordMapper::class => ImdbScraper\Mapper\KeywordMapper::class,
            ImdbScraper\Mapper\ReleaseMapper::class => ImdbScraper\Mapper\ReleaseMapper::class,
            ImdbScraper\Mapper\LocationMapper::class => ImdbScraper\Mapper\LocationMapper::class,
            ImdbScraper\Mapper\ParentalGuideMapper::class => ImdbScraper\Mapper\ParentalGuideMapper::class,
            ImdbScraper\Mapper\CastMapper::class => ImdbScraper\Mapper\CastMapper::class,
            ImdbScraper\Mapper\EpisodeListMapper::class => ImdbScraper\Mapper\EpisodeListMapper::class
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Zend\Cache\Storage\Adapter\Memcached::class => App\Factory\MemcachedFactory::class,
            GraphQL\Type\Schema::class => App\GraphQL\Factory\SchemaFactory::class,
            GraphQL\Server\StandardServer::class => App\GraphQL\Factory\StandardServerFactory::class,
            App\GraphQL\Type\Query::class => App\GraphQL\Factory\QueryFactory::class,
            App\GraphQL\Type\Mutation::class => App\GraphQL\Factory\MutationFactory::class,
            App\GraphQL\Resolver\SearchResolver::class => App\GraphQL\Factory\SearchFactory::class,
            App\GraphQL\Resolver\TapeResolver::class => App\GraphQL\Factory\TapeFactory::class,
            App\GraphQL\Resolver\TapeLanguageResolver::class => App\GraphQL\Factory\TapeLanguageFactory::class,
            App\GraphQL\Resolver\EditTapeUserResolver::class => App\GraphQL\Factory\EditTapeUserFactory::class,
            App\GraphQL\Resolver\ImportImdbMovieResolver::class => App\GraphQL\Factory\ImportImdbMovieFactory::class,
            App\GraphQL\Resolver\ImportImdbEpisodeListResolver::class => App\GraphQL\Factory\ImportImdbEpisodeListFactory::class,
            App\GraphQL\Resolver\BulkImageInsertionResolver::class => App\GraphQL\Factory\BulkImageInsertionFactory::class,
            MongoDB\Client::class => App\Factory\MongoDBClientFactory::class,
            GraphQL\Doctrine\Types::class => App\GraphQL\Factory\TypeFactory::class,
            MongoDB\Driver\Manager::class => App\Factory\MongoDBManagerFactory::class,
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class
        ],
    ],
];
