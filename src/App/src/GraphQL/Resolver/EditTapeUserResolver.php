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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\OptimisticLockException;

class EditTapeUserResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return TapeUser
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(ContainerInterface $container, array $args): TapeUser
    {

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        $place = null;
        $downloaded = false;
        $tapeUserStatusDownloaded = null;
        if (array_key_exists('placeId', $args)) {
            /** @var Place $place */
            $place = $args['placeId']->getEntity();
            if ($place->getPlaceId() == Place::DOWNLOADED) {
                /** @var TapeUserStatus $tapeUserStatusDownloaded */
                $tapeUserStatusDownloaded = $entityManager
                    ->getRepository(TapeUserStatus::class)
                    ->find(TapeUserStatus::DOWNLOADED);
                if ($tapeUserStatusDownloaded) {
                    $downloaded = true;
                }
            }
        }
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();
        /** @var TapeUser $tapeUser */
        $tapeUser = $tape->getTapeUser($user);
        if (!$tapeUser) {
            $tapeUser = new TapeUser();
            $tapeUser->setUser($user);
            $tape->addTapeUser($tapeUser);
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
        return $tapeUser;
    }
}
