<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\GraphQL\Resolver;

use App\Entity\Tape;
use App\Entity\TapeDetail;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class EditTvShowResolver
{

    /**
     * @param EntityManager $entityManager
     * @param array $args
     * @return TapeDetail
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(EntityManager $entityManager, array $args): TapeDetail
    {
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();

        $tapeDetail = null;

        $entityManager->persist($tapeDetail);

        $entityManager->flush();
        return $tapeDetail;
    }
}
