<?php

namespace App\GraphQL\Resolver;

use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ListTapeUserResolver
{

    /**
     * @param QueryBuilder $queryBuilder
     * @param TapeUser[] $args
     * @return array
     */
    public static function resolve(QueryBuilder $queryBuilder, array $args): array
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        $visible = $args['visible'] ?? true;
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

        $queryBuilder
            ->select('l')
            ->from(TapeUser::class, 'l')
//            ->innerJoin(
//                TapeUserHistory::class,
//                'h',
//                Join::ON,
//                $queryBuilder->expr()->eq('l.tapeUser', 'h.tapeUser')
//            )
//            ->innerJoin(
//                TapeUserHistoryDetail::class,
//                'd',
//                Join::ON,
//                $queryBuilder->expr()->eq('h.tapeUserHistory', 'd.tapeUserHistory')
//            )
            ->where('l.user = :user')
//            ->andWhere('d.visible = :visible')
            ->setParameter('user', $user);
//            ->setParameter('visible', $visible);

//        if ($tapeUserStatus) {
//            $queryBuilder
//                ->andWhere('h.tapeUserStatus = :tapeUserStatus')
//                ->setParameter('tapeUserStatus', $tapeUserStatus);
//        }
//
//        if ($place) {
//            $queryBuilder
//                ->andWhere('d.place = :place')
//                ->setParameter('place', $place);
//        }

        $query = $queryBuilder->getQuery();

        return $query->getArrayResult();
    }
}