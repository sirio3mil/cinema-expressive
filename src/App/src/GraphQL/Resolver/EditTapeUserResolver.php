<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\GraphQL\Resolver;


use App\Entity\Place;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\GraphQL\TypeRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\Query;

class EditTapeUserResolver
{

    /**
     * @param EntityManager $entityManager
     * @param array $args
     * @return array
     * @throws \InvalidArgumentException
     */
    public static function getTapes(EntityManager $entityManager, array $args): array
    {
        /** @var Tape[] $tapes */
        $tapes = [];

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('t')
            ->from('App\Entity\Tape', 't');

        if (!empty($args['imdbNumbers'])) {
            /** @var Query $query */

            $queryBuilder->join('App\Entity\ImdbNumber', 'i', 'WITH', 'i.object = t.object')
                ->where($queryBuilder->expr()->in('i.imdbNumber', ':imdbNumbers'))
                ->setParameters([
                    'imdbNumbers' => $args['imdbNumbers']
                ]);
            /** @var Query $query */
            $query = $queryBuilder->getQuery();
            $tapes = array_merge($tapes, $query->getResult());
        }
        if (!empty($args['tapeIds'])) {
            /** @var Query $query */
            $queryBuilder->resetDQLPart('join')
                ->resetDQLPart('where')
                ->where($queryBuilder->expr()->in('t.tapeId', ':tapeIds'))
                ->setParameters([
                    'tapeIds' => $args['tapeIds']
                ]);
            /** @var Query $query */
            $query = $queryBuilder->getQuery();
            $tapes = array_merge($tapes, $query->getResult());
        }

        if (!$tapes) {
            throw new \InvalidArgumentException('Tapes not found');
        }

        return $tapes;
    }

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        $tapes = array_unique(EditTapeUserResolver::getTapes($entityManager, $args));
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
        $place = null;
        $downloaded = false;
        $tapeUserStatusDownloaded = null;
        if (!empty($args['placeId'])) {
            /** @var Place $place */
            $place = $entityManager->getRepository(Place::class)->find($args['placeId']);
            if (!$place) {
                throw new \InvalidArgumentException('Place not found');
            }
            if ($place->getPlaceId() == Place::DOWNLOADED) {
                /** @var TapeUserStatus $tapeUserStatusDownloaded */
                $tapeUserStatusDownloaded = $entityManager->getRepository(TapeUserStatus::class)->find(TapeUserStatus::DOWNLOADED);
                if ($tapeUserStatusDownloaded) {
                    $downloaded = true;
                }
            }
        }
        $tapesUser = [];
        /** @var Tape $tape */
        foreach ($tapes as $tape) {
            /** @var TapeUser $tapeUser */
            $tapeUser = $tape->getUser($user);
            if (!$tapeUser) {
                $tapeUser = new TapeUser();
                $tapeUser->setTape($tape);
                $tapeUser->setUser($user);
            }
            /** @var TapeUserHistory $tapeUserHistory */
            $tapeUserHistory = $tapeUser->getHistoryByStatus($tapeUserStatus);
            if (!$tapeUserHistory) {
                $tapeUserHistory = new TapeUserHistory();
                $tapeUserHistory->setTapeUserStatus($tapeUserStatus);
                $tapeUser->addHistory($tapeUserHistory);
            }
            if ($place) {
                /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
                $tapeUserHistoryDetail = $tapeUserHistory->getDetail();
                if (!$tapeUserHistoryDetail) {
                    $tapeUserHistoryDetail = new TapeUserHistoryDetail();
                    $tapeUserHistory->setDetail($tapeUserHistoryDetail);
                }
                $tapeUserHistoryDetail->setPlace($place);
                if ($downloaded) {
                    /** @var TapeUserHistory $tapeUserHistoryDownloaded */
                    $tapeUserHistoryDownloaded = $tapeUser->getHistoryByStatus($tapeUserStatusDownloaded);
                    if (!$tapeUserHistoryDownloaded) {
                        $tapeUserHistoryDownloaded = new TapeUserHistory();
                        $tapeUserHistoryDownloaded->setTapeUserStatus($tapeUserStatusDownloaded);
                        $tapeUser->addHistory($tapeUserHistoryDownloaded);
                    }
                }
            }
            $entityManager->persist($tapeUser);
            $entityManager->flush();
            $tapesUser[] = $tapeUser;
        }
        return $tapesUser;
    }
}