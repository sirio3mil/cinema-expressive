<?php

namespace App\Resolver;

use App\Entity\OrderedSubscribedTvShows;
use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Exception;
use GraphQL\Doctrine\Annotation as API;
use JetBrains\PhpStorm\ArrayShape;
use function array_key_exists;
use function is_null;

class ListTapeUserResolver extends AbstractResolver implements QueryResolverInterface
{

    use ListOutputTrait;

    public function __construct(EntityManager $entityManager)
    {
        $this->qb = $entityManager->createQueryBuilder();
    }

    /**
     * @API\Field(type="TapeUserPageType")
     *
     * @param User $user
     * @param TapeUserStatus|null $tapeUserStatus
     * @param bool|null $isTvShow
     * @param bool|null $visible
     * @param bool|null $finished
     * @param Place|null $place
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['elements' => "\ArrayIterator", 'total' => "int", 'pages' => "false|float"])]
    protected function execute(
        User $user,
        ?TapeUserStatus $tapeUserStatus,
        ?Place $place,
        ?bool $isTvShow,
        ?bool $visible,
        ?bool $finished,
        int $page,
        int $pageSize
    ): array
    {
        $viewed = $tapeUserStatus->getTapeUserStatusId() === TapeUserStatus::VIEW;
        if ($visible && $isTvShow && !$finished && !$place && $viewed) {
            $this->buildOrderedSubscribedTvShowsQuery($user);
        } elseif ($viewed && !$isTvShow) {
            $this->buildLatestViewedTapesQuery($user, $tapeUserStatus);
        } else {
            $this->buildDefaultQuery($user, $isTvShow, $finished, $tapeUserStatus, $place, $visible);
        }

        return $this->getOutput($page, $pageSize);
    }

    /**
     * @inheritDoc
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['elements' => "\ArrayIterator", 'total' => "int", 'pages' => "false|float"])]
    public function resolve(array $args): array
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        $visible = $args['visible'] ?? null;
        $finished = $args['finished'] ?? null;
        $isTvShow = $args['isTvShow'] ?? null;
        $tapeUserStatus = null;
        $place = null;
        if (array_key_exists('tapeUserStatusId', $args)) {
            /** @var TapeUserStatus $tapeUserStatus */
            $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        }
        if (array_key_exists('placeId', $args)) {
            /** @var Place $place */
            $place = $args['placeId']->getEntity();
        }

        return $this->execute(
            $user,
            $tapeUserStatus,
            $place,
            $isTvShow,
            $visible,
            $finished,
            $args['page'],
            $args['pageSize']
        );
    }

    /**
     * @param User $user
     * @param bool|null $isTvShow
     * @param bool|null $finished
     * @param TapeUserStatus|null $tapeUserStatus
     * @param Place|null $place
     * @param bool|null $visible
     */
    protected function buildDefaultQuery(
        User $user,
        ?bool $isTvShow,
        ?bool $finished,
        ?TapeUserStatus $tapeUserStatus,
        ?Place $place,
        ?bool $visible
    ): void
    {
        $this->qb
            ->select('l')
            ->from(TapeUser::class, 'l')
            ->innerJoin(
                'l.tape',
                't'
            )
            ->innerJoin(
                't.detail',
                'dt'
            )
            ->where('l.user = :user')
            ->andWhere('dt.tvShowChapter = :isTvShowChapter')
            ->setParameters([
                'user' => $user,
                'isTvShowChapter' => false
            ]);

        if (!is_null($isTvShow)) {
            $this->qb
                ->andWhere('dt.tvShow = :isTvShow')
                ->setParameter('isTvShow', $isTvShow);
        }

        if (!is_null($finished)) {
            $this->qb
                ->innerJoin('t.tvShow', 's')
                ->andWhere('s.finished = :finished')
                ->setParameter('finished', $finished);
        }

        if ($tapeUserStatus || $place || !is_null($visible)) {
            $this->qb->innerJoin(
                'l.history',
                'h'
            );
            $this->qb->orderBy('h.createdAt', 'desc');
            if ($tapeUserStatus) {
                $this->qb
                    ->andWhere('h.tapeUserStatus = :tapeUserStatus')
                    ->andWhere('h.deletedAt is NULL')
                    ->setParameter('tapeUserStatus', $tapeUserStatus);
            }
            if ($place || !is_null($visible)) {
                $this->qb->innerJoin(
                    'h.details',
                    'd'
                );
                if ($place) {
                    $this->qb
                        ->andWhere('d.place = :place')
                        ->setParameter('place', $place);
                }
                if (!is_null($visible)) {
                    $this->qb
                        ->andWhere('d.visible = :visible')
                        ->setParameter('visible', $visible);
                }
            }
        }
    }

    /**
     * @param User $user
     */
    protected function buildOrderedSubscribedTvShowsQuery(User $user): void
    {
        $comparison = $this->qb->expr()->eq('o.tapeUser', 'l.tapeUserId');
        $this->qb
            ->select('l')
            ->from(TapeUser::class, 'l')
            ->innerJoin(OrderedSubscribedTvShows::class, 'o', Join::WITH, $comparison)
            ->where('o.user = :user')
            ->orderBy('o.updatedAt', 'desc')
            ->setParameter('user', $user);
    }

    protected function buildLatestViewedTapesQuery(User $user, TapeUserStatus $tapeUserStatus)
    {
        $this->qb
            ->select('l')
            ->from(TapeUser::class, 'l')
            ->innerJoin('l.tape', 't')
            ->innerJoin('t.detail', 'dt')
            ->innerJoin('l.history', 'h')
            ->innerJoin('h.details', 'd')
            ->where('l.user = :user')
            ->andWhere('dt.tvShowChapter = :isTvShowChapter')
            ->andWhere('dt.tvShow = :isTvShow')
            ->andWhere('h.tapeUserStatus = :tapeUserStatus')
            ->andWhere('h.deletedAt is NULL')
            ->orderBy('d.createdAt', 'desc')
            ->setParameters([
                'user' => $user,
                'isTvShowChapter' => false,
                'isTvShow' => false,
                'tapeUserStatus' => $tapeUserStatus
            ]);
    }
}
