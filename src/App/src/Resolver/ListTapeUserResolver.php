<?php

namespace App\Resolver;

use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\Helper\ListOutputHelper;
use Doctrine\ORM\QueryBuilder;
use function array_key_exists;
use function is_null;

class ListTapeUserResolver
{

    /**
     * @param QueryBuilder $qb
     * @param TapeUser[] $args
     * @return array
     */
    public static function resolve(QueryBuilder $qb, array $args): array
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

        $qb
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
            ->andWhere('dt.isTvShowChapter = :isTvShowChapter')
            ->setParameters([
                'user' => $user,
                'isTvShowChapter' => false
            ]);

        if (!is_null($isTvShow)) {
            $qb
                ->andWhere('dt.isTvShow = :isTvShow')
                ->setParameter('isTvShow', $isTvShow);
        }

        if (!is_null($finished)) {
            $qb
                ->innerJoin('t.tvShow', 's')
                ->andWhere('s.finished = :finished')
                ->setParameter('finished', $finished);
        }

        if ($tapeUserStatus || $place || !is_null($visible)) {
            $qb->innerJoin(
                'l.history',
                'h'
            );
            if ($tapeUserStatus) {
                $qb
                    ->andWhere('h.tapeUserStatus = :tapeUserStatus')
                    ->setParameter('tapeUserStatus', $tapeUserStatus);
            }
            if ($place || !is_null($visible)) {
                $qb->innerJoin(
                    'h.detail',
                    'd'
                );
                if ($place) {
                    $qb
                        ->andWhere('d.place = :place')
                        ->setParameter('place', $place);
                }
                if (!is_null($visible)) {
                    $qb
                        ->andWhere('d.visible = :visible')
                        ->setParameter('visible', $visible);
                }
            }
        }

        return ListOutputHelper::getType($qb, $args);
    }
}
