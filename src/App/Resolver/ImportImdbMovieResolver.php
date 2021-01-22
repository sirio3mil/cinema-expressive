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
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\ResultSetMapping;

class ImportImdbMovieResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * ImportImdbMovieResolver constructor.
     * @param EntityManager $entityManager
     * @param ImportImdbMovieService $importImdbMovieService
     */
    public function __construct(
        private EntityManager $entityManager,
        private ImportImdbMovieService $importImdbMovieService
    )
    {
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
        $this->importImdbMovieService->setImdbNumber($imdbNumber);
        $this->importImdbMovieService->import();
        $tape = $this->importImdbMovieService->getTape();
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
