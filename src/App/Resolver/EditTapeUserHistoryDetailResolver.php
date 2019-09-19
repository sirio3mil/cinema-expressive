<?php


namespace App\Resolver;

use App\Entity\Place;
use App\Entity\Tape;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
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
    protected $qb;

    /**
     * EditTapeUserHistoryDetailResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->qb = $entityManager->createQueryBuilder();
    }

    /**
     * @param Tape $tape
     * @param User $user
     * @param TapeUserStatus $tapeUserStatus
     * @param array $input
     * @return TapeUserHistoryDetail
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(
        Tape $tape,
        User $user,
        TapeUserStatus $tapeUserStatus,
        array $input
    ): TapeUserHistoryDetail
    {
        $this->qb
            ->select('h')
            ->from(TapeUserHistory::class, 'h')
            ->innerJoin('h.tapeUser', 't')
            ->where('t.tape = :tape')
            ->andWhere('t.user = :user')
            ->andWhere('h.tapeUserStatus = :tapeUserStatus')
            ->setParameters([
                'tape' => $tape,
                'user' => $user,
                'tapeUserStatus' => $tapeUserStatus
            ]);

        /** @var TapeUserHistory $tapeUserHistory */
        $tapeUserHistory = $this->qb->getQuery()->getSingleResult();

        $tapeUserHistoryDetail = $tapeUserHistory->getDetail();
        if (!$tapeUserHistoryDetail) {
            $tapeUserHistoryDetail = new TapeUserHistoryDetail();
            $tapeUserHistoryDetail->setTapeUserHistory($tapeUserHistory);
        }

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
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();

        return $this->execute($tape, $user, $tapeUserStatus, $args['input']);
    }
}
