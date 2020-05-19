<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:23
 */

namespace App\Resolver;

use App\Entity\Tape;
use App\Entity\TapeDefaultValue;
use App\Service\ImportImdbMovieService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query\ResultSetMapping;

class ImportImdbMovieResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;
    /**
     * @var ImportImdbMovieService
     */
    private ImportImdbMovieService $service;

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
        $tape = $this->service->getTape();
        $this->entityManager->persist($tape);
        $this->entityManager->flush();

        $sql = "exec [dbo].[UpdateTapeDefaultValues]";
        $query = $this->entityManager->createNativeQuery($sql, new ResultSetMapping());
        $query->execute();

        /** @var TapeDefaultValue $tapeDefaultValue */
        $tapeDefaultValue = $this->entityManager
            ->getRepository(TapeDefaultValue::class)
            ->find($tape->getTapeId());
        if ($tapeDefaultValue) {
            $tape->setDefault($tapeDefaultValue);
        }

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
