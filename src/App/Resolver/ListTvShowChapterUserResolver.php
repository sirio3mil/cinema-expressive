<?php


namespace App\Resolver;

use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\TvShow;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\OrderBy;
use GraphQL\Doctrine\Annotation as API;

class ListTvShowChapterUserResolver extends AbstractResolver implements QueryResolverInterface
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
     * @param TvShow $tvShow
     * @param TapeUserStatus $tapeUserStatus
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    protected function execute(
        User $user,
        TvShow $tvShow,
        TapeUserStatus $tapeUserStatus,
        int $page,
        int $pageSize
    ): array
    {
        $orderBy = new OrderBy('ch.season', 'desc');
        $orderBy->add('ch.chapter', 'desc');

        $this->qb
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

        return $this->getOutput($page, $pageSize);
    }

    /**
     * @param array $args
     * @return array
     */
    public function resolve(array $args): array
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TvShow $tvShow */
        $tvShow = $args['tvShowId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();

        return $this->execute(
            $user,
            $tvShow,
            $tapeUserStatus,
            $args['page'],
            $args['pageSize']
        );
    }
}
