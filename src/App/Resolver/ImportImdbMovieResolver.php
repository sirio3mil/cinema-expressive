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

class ImportImdbMovieResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var ImportImdbMovieService
     */
    private $service;

    /**
     * ImportImdbMovieResolver constructor.
     * @param EntityManager $entityManager
     * @param ImportImdbMovieService $service
     */
    public function __construct(EntityManager $entityManager, ImportImdbMovieService $service)
    {
        $this->entityManager = $entityManager;
        $this->service = $service;
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
        $this->service->setImdbNumber($imdbNumber);
        $this->service->import();
        /** @var Tape $tape */
        $tape = $this->service->getTape();
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
