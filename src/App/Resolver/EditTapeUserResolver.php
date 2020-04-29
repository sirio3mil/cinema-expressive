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
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\Service\TapeUserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class EditTapeUserResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var TapeUserService
     */
    private TapeUserService $tapeUserService;

    /**
     * EditTapeUserResolver constructor.
     * @param EntityManager $entityManager
     * @param TapeUserService $tapeUserService
     */
    public function __construct(EntityManager $entityManager, TapeUserService $tapeUserService)
    {
        $this->entityManager = $entityManager;
        $this->tapeUserService = $tapeUserService;
    }

    /**
     * @param User $user
     * @param Tape $tape
     * @param TapeUserStatus $tapeUserStatus
     * @param Place|null $place
     * @return TapeUser
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(User $user, Tape $tape, TapeUserStatus $tapeUserStatus, ?Place $place = null): TapeUser
    {
        $tapeUser = $this->tapeUserService->getTapeUser($user, $tapeUserStatus, $place, $tape);
        $this->entityManager->persist($tapeUser);
        $this->entityManager->flush();

        return $tapeUser;
    }

    /**
     * @param array $args
     * @return TapeUser
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): TapeUser
    {
        /** @var User $user */
        $user = $args['userId']->getEntity();
        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $args['tapeUserStatusId']->getEntity();
        $place = null;
        if (array_key_exists('placeId', $args)) {
            $place = $args['placeId']->getEntity();
        }
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();

        return $this->execute($user, $tape, $tapeUserStatus, $place);
    }
}
