<?php

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
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
            DateTime::class => App\Type\DateTimeType::class,
            ImdbScraper\Mapper\HomeMapper::class => ImdbScraper\Mapper\HomeMapper::class,
            ImdbScraper\Mapper\KeywordMapper::class => ImdbScraper\Mapper\KeywordMapper::class,
            ImdbScraper\Mapper\ReleaseMapper::class => ImdbScraper\Mapper\ReleaseMapper::class,
            ImdbScraper\Mapper\LocationMapper::class => ImdbScraper\Mapper\LocationMapper::class,
            ImdbScraper\Mapper\ParentalGuideMapper::class => ImdbScraper\Mapper\ParentalGuideMapper::class,
            ImdbScraper\Mapper\CastMapper::class => ImdbScraper\Mapper\CastMapper::class,
            ImdbScraper\Mapper\EpisodeListMapper::class => ImdbScraper\Mapper\EpisodeListMapper::class,
            Ausi\SlugGenerator\SlugGenerator::class => Ausi\SlugGenerator\SlugGenerator::class,
            AnnotationReader::class => AnnotationReader::class
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Zend\Cache\Storage\Adapter\Memcached::class => App\Factory\MemcachedFactory::class,
            App\Type\TapeUserPageType::class => App\Factory\TapeUserPageTypeFactory::class,
            MongoDB\Client::class => App\Factory\MongoDBClientFactory::class,
            GraphQL\Doctrine\Types::class => App\Factory\TypeFactory::class,
            MongoDB\Driver\Manager::class => App\Factory\MongoDBManagerFactory::class,
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class,
            Tuupola\Middleware\CorsMiddleware::class => App\Factory\CorsMiddlewareFactory::class
        ],
    ],
];
