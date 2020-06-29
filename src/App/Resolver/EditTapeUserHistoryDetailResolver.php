<?php

namespace App\Resolver;

use App\Entity\Place;
use App\Entity\TapeUserHistoryDetail;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use function array_key_exists;

class EditTapeUserHistoryDetailResolver extends AbstractResolver implements MutationResolverInterface
{

    /**
     * @var QueryBuilder
     */
    protected QueryBuilder $qb;

    /**
     * EditTapeUserHistoryDetailResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->qb = $entityManager->createQueryBuilder();
    }

    /**
     * @param TapeUserHistoryDetail $tapeUserHistoryDetail
     * @param array $input
     * @return TapeUserHistoryDetail
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(TapeUserHistoryDetail $tapeUserHistoryDetail, array $input): TapeUserHistoryDetail
    {
        if (array_key_exists('place', $input)) {
            /** @var Place $place */
            $place = $input['place']->getEntity();
            $tapeUserHistoryDetail->setPlace($place);
        }
        if (array_key_exists('visible', $input)) {
            $tapeUserHistoryDetail->setVisible($input['visible']);
        }
        if (array_key_exists('exported', $input)) {
            $tapeUserHistoryDetail->setVisible($input['exported']);
        }

        $this->qb->getEntityManager()->persist($tapeUserHistoryDetail);
        $this->qb->getEntityManager()->flush();

        return $tapeUserHistoryDetail;
    }

    /**
     * @param array $args
     * @return TapeUserHistoryDetail
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): TapeUserHistoryDetail
    {
        /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
        $tapeUserHistoryDetail = $args['tapeUserHistoryDetailId']->getEntity();

        return $this->execute($tapeUserHistoryDetail, $args['input']);
    }
}
