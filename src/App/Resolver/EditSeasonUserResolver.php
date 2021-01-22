<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\Resolver;

use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\TvShow;
use App\Entity\TvShowChapter;
use App\Entity\User;
use App\Service\TapeUserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GraphQL\Doctrine\Annotation as API;
use function array_key_exists;

class EditSeasonUserResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * EditSeasonUserResolver constructor.
     * @param EntityManager $entityManager
     * @param TapeUserService $tapeUserService
     */
    public function __construct(
        private EntityManager $entityManager,
        private TapeUserService $tapeUserService
    )
    {
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
        foreach ($chapters as $tvShowChapter) {
            $tapeUser = $this->tapeUserService->getTapeUser($user, $tapeUserStatus, $place, $tvShowChapter->getTape());
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
}
