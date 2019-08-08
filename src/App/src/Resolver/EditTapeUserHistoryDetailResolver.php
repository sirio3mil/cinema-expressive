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
use function array_key_exists;

class EditTapeUserHistoryDetailResolver
{
    /**
     * @param EntityManager $entityManager
     * @param array $args
     * @return TapeUserHistoryDetail
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(EntityManager $entityManager, array $args): TapeUserHistoryDetail
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();

        $qb = $entityManager->createQueryBuilder();

        $qb
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
        $tapeUserHistory = $qb->getQuery()->getSingleResult();

        $tapeUserHistoryDetail = $tapeUserHistory->getDetail();
        if (!$tapeUserHistoryDetail) {
            $tapeUserHistoryDetail = new TapeUserHistoryDetail();
            $tapeUserHistoryDetail->setTapeUserHistory($tapeUserHistory);
        }

        if (array_key_exists('place', $args['input'])) {
            /** @var Place $place */
            $place = $args['input']['place']->getEntity();
            $tapeUserHistoryDetail->setPlace($place);
        }
        if (array_key_exists('visible', $args['input'])) {
            $tapeUserHistoryDetail->setVisible($args['input']['visible']);
        }
        if (array_key_exists('exported', $args['input'])) {
            $tapeUserHistoryDetail->setVisible($args['input']['exported']);
        }

        $entityManager->persist($tapeUserHistoryDetail);

        $entityManager->flush();
        return $tapeUserHistoryDetail;
    }
}
