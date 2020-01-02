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
use App\Entity\TvShow;
use App\Entity\TvShowChapter;
use App\Entity\User;
use GraphQL\Doctrine\Annotation as API;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class EditSeasonUserResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * EditSeasonUserResolver constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @API\Field(type="TapeUser[]")
     *
     * @param User $user
     * @param TvShow $tvShow
     * @param TapeUserStatus $tapeUserStatus
     * @param int $season
     * @param Place|null $place
     * @return array
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(User $user, TvShow $tvShow, TapeUserStatus $tapeUserStatus, int $season, ?Place $place = null): array
    {
        $edited = [];
        /** @var TvShowChapter[] $chapters */
        $chapters = $tvShow->getChaptersBySeason($season);
        foreach ($chapters as $tvShowChapter){
            $tapeUser = $this->getTapeUser($user, $tapeUserStatus, $place, $tvShowChapter->getTape());
            $this->entityManager->persist($tapeUser);
            $edited[] = $tapeUser;
        }
        $this->entityManager->flush();

        return $edited;
    }

    /**
     * @param array $args
     * @return TapeUser[]
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): array
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        $place = null;
        if (array_key_exists('placeId', $args)) {
            $place = $args['placeId']->getEntity();
        }
        /** @var TvShow $tvShow */
        $tvShow = $args['tvShowId']->getEntity();

        return $this->execute($user, $tvShow, $tapeUserStatus, $args['season'], $place);
    }

    /**
     * @param User $user
     * @param TapeUserStatus $tapeUserStatus
     * @param Place|null $place
     * @param Tape $tape
     * @return TapeUser
     */
    protected function getTapeUser(User $user, TapeUserStatus $tapeUserStatus, ?Place $place, Tape $tape): TapeUser
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

        return $tapeUser;
    }
}
