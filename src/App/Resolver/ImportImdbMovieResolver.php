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

class ImportImdbMovieResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var SlugGenerator
     */
    private $slugGenerator;

    /**
     * ImportImdbMovieResolver constructor.
     * @param EntityManager $entityManager
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(EntityManager $entityManager, SlugGenerator $slugGenerator)
    {
        $this->entityManager = $entityManager;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * @param int $imdbNumber
     * @return Tape
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(int $imdbNumber): Tape
    {
        /** @var ImportImdbMovieService $importImdbMovieService */
        $importImdbMovieService = new ImportImdbMovieService($this->entityManager, $this->slugGenerator);
        $importImdbMovieService->setImdbNumber($imdbNumber);
        $importImdbMovieService->import();
        /** @var Tape $tape */
        $tape = $importImdbMovieService->getTape();
        $this->entityManager->persist($tape);
        $this->entityManager->flush();
        return $tape;
    }

    /**
     * @param array $args
     * @return Tape
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): Tape
    {
        return $this->execute($args['imdbNumber']);
    }
}
