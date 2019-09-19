<?php

namespace App\Resolver;

use App\Entity\Place;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Annotation as API;
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
     */
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
            ->andWhere('dt.isTvShowChapter = :isTvShowChapter')
            ->setParameters([
                'user' => $user,
                'isTvShowChapter' => false
            ]);

        if (!is_null($isTvShow)) {
            $this->qb
                ->andWhere('dt.isTvShow = :isTvShow')
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
            if ($tapeUserStatus) {
                $this->qb
                    ->andWhere('h.tapeUserStatus = :tapeUserStatus')
                    ->setParameter('tapeUserStatus', $tapeUserStatus);
            }
            if ($place || !is_null($visible)) {
                $this->qb->innerJoin(
                    'h.detail',
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

        return $this->getOutput($page, $pageSize);
    }

    /**
     * @inheritDoc
     * @return array
     */
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
}
