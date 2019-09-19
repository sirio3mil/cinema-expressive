<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\Resolver;

use App\Entity\Place;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class EditTapeUserResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @param Tape $tape
     * @param TapeUserStatus $tapeUserStatus
     * @param Place|null $place
     * @return TapeUser
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(User $user, Tape $tape, TapeUserStatus $tapeUserStatus, ?Place $place = null): TapeUser
    {
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
            if ($place->getPlaceId() == Place::DOWNLOADED) {
                /** @var TapeUserStatus $tapeUserStatusDownloaded */
                $tapeUserStatusDownloaded = $this->entityManager
                    ->getRepository(TapeUserStatus::class)
                    ->find(TapeUserStatus::DOWNLOADED);
                if ($tapeUserStatusDownloaded) {
                    /** @var TapeUserHistory $tapeUserHistoryDownloaded */
                    $tapeUserHistoryDownloaded = $tapeUser->getHistoryByStatus($tapeUserStatusDownloaded);
                    if (!$tapeUserHistoryDownloaded) {
                        $tapeUserHistoryDownloaded = new TapeUserHistory();
                        $tapeUserHistoryDownloaded->setTapeUserStatus($tapeUserStatusDownloaded);
                        $tapeUser->addHistory($tapeUserHistoryDownloaded);
                    }
                }
            }
        }
        $this->entityManager->persist($tapeUser);
        $this->entityManager->flush();

        return $tapeUser;
    }

    /**
     * @param array $args
     * @return TapeUser
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): TapeUser
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        $place = null;
        if (array_key_exists('placeId', $args)) {
            $place = $args['placeId']->getEntity();
        }
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();

        return $this->execute($user, $tape, $tapeUserStatus, $place);
    }
}
