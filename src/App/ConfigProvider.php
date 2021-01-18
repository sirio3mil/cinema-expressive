<?php

declare(strict_types=1);

namespace App;

use App\Command\CheckEpisodes;
use App\Command\CheckEpisodesFactory;
use App\Factory\GraphQLHandlerFactory;
use App\Handler\GraphQLHandler;
use JetBrains\PhpStorm\ArrayShape;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    #[ArrayShape(['dependencies' => "\string[][]", 'templates' => "array[]", 'laminas-cli' => "\string[][]"])] public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'laminas-cli' => $this->getCliConfig(),
        ];
    }

    #[ArrayShape(['commands' => "string[]"])] public function getCliConfig(): array
    {
        return [
            'commands' => [
                'app:check-episodes' => CheckEpisodes::class,
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    #[ArrayShape(['factories' => "string[]"])] public function getDependencies(): array
    {
        return [
            'factories' => [
                GraphQLHandler::class => GraphQLHandlerFactory::class,
                CheckEpisodes::class => CheckEpisodesFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    #[ArrayShape(['paths' => "array"])] public function getTemplates(): array
    {
        return [
            'paths' => [
            ],
        ];
    }
}
