<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\GraphQL\Resolver;


use App\Entity\ImdbNumber;
use App\Entity\Place;
use App\Entity\RowType;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\GraphQL\TypeRegistry;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\Query;

class EditTapeUserResolver
{

    /**
     * @param TypeRegistry $typeRegistry
     * @param array $args
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {

        /** @var ContainerInterface $container */
        $container = $typeRegistry->getContainer();

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        if (empty($args['tapeId'])) {
            if (empty($args['imdbNumber'])) {
                throw new \InvalidArgumentException('Undefined Tape');
            }
            /** @var Query $query */
            $query = $entityManager->createQuery('
                    SELECT t 
                    FROM App\Entity\Tape t 
                    JOIN App\Entity\ImdbNumber i 
                        WITH i.object = t.object
                    JOIN i.object o 
                    JOIN o.rowType r
                    WHERE i.imdbNumber = :imdbNumber 
                        AND r.rowTypeId = :rowTypeId'
            );
            $query->setParameters([
                'imdbNumber' => $args['imdbNumber'],
                'rowTypeId' => RowType::ROW_TYPE_TAPE
            ]);
            $tape = $query->getSingleResult();
        } else {
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->find($args['tapeId']);
        }

        if (!$tape) {
            throw new \InvalidArgumentException('Tape not found');
        }

        /** @var User $user */
        $user = $entityManager->getRepository(User::class)->find($args['userId']);

        if (!$user) {
            throw new \InvalidArgumentException('User not found');
        }

        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $entityManager->getRepository(TapeUserStatus::class)->find($args['tapeUserStatusId']);

        if (!$tapeUserStatus) {
            throw new \InvalidArgumentException('Tape user status not found');
        }

        /** @var Query $query */
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\TapeUser i WHERE i.tape = :tape AND i.user = :user');
        $query->setParameters([
            'tape' => $tape,
            'user' => $user
        ]);
        /** @var TapeUser $tapeUser */
        $tapeUser = $query->getOneOrNullResult();
        if (!$tapeUser) {
            $tapeUser = new TapeUser();
            $tapeUser->setTape($tape);
            $tapeUser->setUser($user);
            $entityManager->persist($tapeUser);
            $entityManager->flush();
        }

        /** @var Query $query */
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\TapeUserHistory i WHERE i.tapeUser = :tapeUser AND i.tapeUserStatus = :tapeUserStatus');
        $query->setParameters([
            'tapeUser' => $tapeUser,
            'tapeUserStatus' => $tapeUserStatus
        ]);
        /** @var TapeUserHistory $tapeUserHistory */
        $tapeUserHistory = $query->getOneOrNullResult();
        if (!$tapeUserHistory) {
            $tapeUserHistory = new TapeUserHistory();
            $tapeUserHistory->setTapeUser($tapeUser);
            $tapeUserHistory->setTapeUserStatus($tapeUserStatus);
            $entityManager->persist($tapeUserHistory);
            $entityManager->flush();
        }

        if (!empty($args['placeId'])) {

            /** @var Place $place */
            $place = $entityManager->getRepository(Place::class)->find($args['placeId']);

            if (!$place) {
                throw new \InvalidArgumentException('Place not found');
            }

            /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
            $tapeUserHistoryDetail = $entityManager->getRepository(TapeUserHistoryDetail::class)->findOneBy([
                'tapeUserHistory' => $tapeUserHistory
            ]);

            if (!$tapeUserHistoryDetail) {
                $tapeUserHistoryDetail = new TapeUserHistoryDetail();
                $tapeUserHistoryDetail->setTapeUserHistory($tapeUserHistory);
                $tapeUserHistoryDetail->setPlace($place);
                $entityManager->persist($tapeUserHistoryDetail);
                $entityManager->flush();
            }
        }

        return [
            'tapeUserId' => $tapeUser->getTapeUserId(),
            'tapeUserHistoryId' => $tapeUserHistory->getTapeUserHistoryId()
        ];
    }
}