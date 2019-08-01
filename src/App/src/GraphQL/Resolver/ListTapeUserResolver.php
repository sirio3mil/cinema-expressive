<?php

namespace App\GraphQL\Resolver;

use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
        $visible = $args['visible'] ?? false;
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
            ->where('l.user = :user')
            ->setParameter('user', $user);

        if ($tapeUserStatus || $place || $visible) {
            $queryBuilder->innerJoin(
                'l.tapeUser',
                'h'
            );
            if ($tapeUserStatus) {
                $queryBuilder
                    ->andWhere('h.tapeUserStatus = :tapeUserStatus')
                    ->setParameter('tapeUserStatus', $tapeUserStatus);
            }
            if ($place || $visible) {
                $queryBuilder->innerJoin(
                    'h.tapeUserHistory',
                    'd'
                );
                if ($place) {
                    $queryBuilder
                        ->andWhere('d.place = :place')
                        ->setParameter('place', $place);
                }
                if ($visible) {
                    $queryBuilder
                        ->andWhere('d.visible = :visible')
                        ->setParameter('visible', $visible);
                }
            }
        }

        $paginator = new Paginator($queryBuilder);

        $totalItems = count($paginator);
        $pageSize = $args['pageSize'];

        $pagesCount = ceil($totalItems / $pageSize);

        $currentPage = $args['page'];
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage-1))
            ->setMaxResults($pageSize);


        return [
            'elements' => $paginator->getIterator(),
            'total' => $totalItems,
            'pages' => $pagesCount
        ];
    }
}