<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\Resolver;

use App\Entity\Tape;
use App\Entity\TvShow;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use InvalidArgumentException;

class EditTvShowResolver
{

    /**
     * @param EntityManager $entityManager
     * @param array $args
     * @return TvShow
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(EntityManager $entityManager, array $args): TvShow
    {
        if (!isset($args['input']['tape'])) {
            throw new InvalidArgumentException('Tape is mandatory');
        }
        /** @var Tape $tape */
        $tape = $args['input']['tape']->getEntity();
        $finished = $args['input']['finished'] ?? false;
        $tvShow = $tape->getTvShow();
        if (!$tvShow) {
            throw new InvalidArgumentException('Tape does not have Tv Show');
        }
        $tvShow->setFinished($finished);
        $entityManager->persist($tvShow);
        $entityManager->flush();
        return $tvShow;
    }
}
