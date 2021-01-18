<?php

namespace App\Command;

use App\Service\ImportImdbMovieService;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use ImdbScraper\Mapper\EpisodeListMapper;
use Psr\Container\ContainerInterface;

class CheckEpisodesFactory
{
    public function __invoke(ContainerInterface $container): CheckEpisodes
    {
        AnnotationRegistry::registerLoader('class_exists');
        return new CheckEpisodes(
            $container->get(EntityManager::class),
            new ImportImdbMovieService(
                $container->get(EntityManager::class),
                $container->get(SlugGenerator::class),
            ),
            $container->get(EpisodeListMapper::class),
        );
    }
}
