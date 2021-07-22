<?php

namespace App\Command;

use App\Service\ImportImdbMovieService;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ImportTapeFactory
{
    public function __invoke(ContainerInterface $container): ImportTape
    {
        AnnotationRegistry::registerLoader('class_exists');
        return new ImportTape(
            $container->get(EntityManager::class),
            new ImportImdbMovieService(
                $container->get(EntityManager::class),
                $container->get(SlugGenerator::class),
            ),
        );
    }
}
