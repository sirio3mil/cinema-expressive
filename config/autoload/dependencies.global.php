<?php

declare(strict_types=1);

use Zend\Expressive\Authentication;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            Authentication\AuthenticationInterface::class => Authentication\OAuth2\OAuth2Adapter::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            DateTime::class => App\GraphQL\Type\DateTimeType::class,
            ImdbScraper\Mapper\HomeMapper::class => ImdbScraper\Mapper\HomeMapper::class,
            ImdbScraper\Mapper\KeywordMapper::class => ImdbScraper\Mapper\KeywordMapper::class,
            ImdbScraper\Mapper\ReleaseMapper::class => ImdbScraper\Mapper\ReleaseMapper::class,
            ImdbScraper\Mapper\LocationMapper::class => ImdbScraper\Mapper\LocationMapper::class,
            ImdbScraper\Mapper\ParentalGuideMapper::class => ImdbScraper\Mapper\ParentalGuideMapper::class,
            ImdbScraper\Mapper\CastMapper::class => ImdbScraper\Mapper\CastMapper::class,
            ImdbScraper\Mapper\EpisodeListMapper::class => ImdbScraper\Mapper\EpisodeListMapper::class,
            Ausi\SlugGenerator\SlugGenerator::class => Ausi\SlugGenerator\SlugGenerator::class
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Zend\Cache\Storage\Adapter\Memcached::class => App\Factory\MemcachedFactory::class,
            GraphQL\Type\Schema::class => App\GraphQL\Factory\SchemaFactory::class,
            GraphQL\Server\StandardServer::class => App\GraphQL\Factory\StandardServerFactory::class,
            App\GraphQL\Type\QueryType::class => App\GraphQL\Factory\QueryFactory::class,
            App\GraphQL\Type\MutationType::class => App\GraphQL\Factory\MutationFactory::class,
            App\GraphQL\Type\TapeUserPageType::class => App\GraphQL\Factory\TapeUserPageTypeFactory::class,
            App\GraphQL\Resolver\SearchResolver::class => App\GraphQL\Factory\SearchFactory::class,
            App\GraphQL\Resolver\TapeResolver::class => App\GraphQL\Factory\TapeFactory::class,
            App\GraphQL\Resolver\ListTapeUserResolver::class => App\GraphQL\Factory\ListTapeUserFactory::class,
            App\GraphQL\Resolver\TapeLanguageResolver::class => App\GraphQL\Factory\TapeLanguageFactory::class,
            App\GraphQL\Resolver\EditTapeUserResolver::class => App\GraphQL\Factory\EditTapeUserFactory::class,
            App\GraphQL\Resolver\EditTapeUserHistoryDetailResolver::class
                => App\GraphQL\Factory\EditTapeUserHistoryDetailFactory::class,
            App\GraphQL\Resolver\EditTvShowResolver::class => App\GraphQL\Factory\EditTvShowFactory::class,
            App\GraphQL\Resolver\ImportImdbMovieResolver::class => App\GraphQL\Factory\ImportImdbMovieFactory::class,
            App\GraphQL\Resolver\ImportImdbEpisodesResolver::class
                => App\GraphQL\Factory\ImportImdbEpisodesFactory::class,
            MongoDB\Client::class => App\Factory\MongoDBClientFactory::class,
            GraphQL\Doctrine\Types::class => App\GraphQL\Factory\TypeFactory::class,
            MongoDB\Driver\Manager::class => App\Factory\MongoDBManagerFactory::class,
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class,
            Tuupola\Middleware\CorsMiddleware::class => App\Factory\CorsMiddlewareFactory::class
        ],
    ],
];
