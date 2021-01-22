<?php

namespace App\Service;

use App\Entity\Place;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class TapeUserService
{
    /**
     * EditSeasonUserResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(private EntityManager $entityManager)
    {
    }

    /**
     * @param User $user
     * @param TapeUserStatus $tapeUserStatus
     * @param Place|null $place
     * @param Tape $tape
     * @return TapeUser
     */
    public function getTapeUser(User $user, TapeUserStatus $tapeUserStatus, ?Place $place, Tape $tape): TapeUser
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
            $tapeUserHistoryDetail = new TapeUserHistoryDetail();
            $tapeUserHistory->addDetail($tapeUserHistoryDetail);
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

        return $tapeUser;
    }
}
