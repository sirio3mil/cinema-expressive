<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:23
 */

namespace App\Resolver;

use App\Entity\Tape;
use App\Service\ImportImdbMovieService;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Container\ContainerInterface;

class ImportImdbMovieResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return Tape
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(ContainerInterface $container, array $args): Tape
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var SlugGenerator $slugGenerator */
        $slugGenerator = $container->get(SlugGenerator::class);
        /** @var ImportImdbMovieService $importImdbMovieService */
        $importImdbMovieService = new ImportImdbMovieService($entityManager, $slugGenerator);
        $importImdbMovieService->setImdbNumber($args['imdbNumber']);
        $importImdbMovieService->import();
        /** @var Tape $tape */
        $tape = $importImdbMovieService->getTape();
        $entityManager->persist($tape);
        $entityManager->flush();
        return $tape;
    }
}
