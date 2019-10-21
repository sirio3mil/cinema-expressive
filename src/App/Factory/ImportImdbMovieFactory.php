<?php

namespace App\Factory;

use App\Service\ImportImdbMovieService;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ImportImdbMovieFactory
{
    /**
     * @param ContainerInterface $container
     * @return ImportImdbMovieService
     */
    public function __invoke(ContainerInterface $container): ImportImdbMovieService
    {
        return new ImportImdbMovieService(
            $container->get(EntityManager::class),
            $container->get(SlugGenerator::class)
        );
    }
}
