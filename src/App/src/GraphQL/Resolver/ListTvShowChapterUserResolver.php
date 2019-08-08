<?php


namespace App\GraphQL\Resolver;

use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\TvShow;
use App\Entity\User;
use App\Helper\ListOutputHelper;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\QueryBuilder;

class ListTvShowChapterUserResolver
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
        /** @var TvShow $tvShow */
        $tvShow = $args['tvShow']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();

        $orderBy = new OrderBy('ch.season', 'desc');
        $orderBy->add('ch.chapter', 'desc');

        $qb
            ->select('l')
            ->from(TapeUser::class, 'l')
            ->innerJoin(
                'l.tape',
                't'
            )
            ->innerJoin(
                'l.history',
                'h'
            )
            ->innerJoin(
                't.tvShowChapter',
                'ch'
            )
            ->where('l.user = :user')
            ->andWhere('ch.tvShow = :tvShow')
            ->andWhere('h.tapeUserStatus = :tapeUserStatus')
            ->orderBy($orderBy)
            ->setParameters([
                'user' => $user,
                'tvShow' => $tvShow,
                'tapeUserStatus' => $tapeUserStatus
            ]);

        return ListOutputHelper::getType($qb, $args);
    }
}
