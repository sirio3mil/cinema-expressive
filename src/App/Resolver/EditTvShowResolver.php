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

class EditTvShowResolver extends AbstractResolver implements MutationResolverInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $input
     * @return TvShow
     * @throws InvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(array $input): TvShow
    {
        if (!isset($input['tape'])) {
            throw new InvalidArgumentException('Tape is mandatory');
        }

        /** @var Tape $tape */
        $tape = $input['tape']->getEntity();
        $finished = $input['finished'] ?? false;
        $tvShow = $tape->getTvShow();
        if (!$tvShow) {
            throw new InvalidArgumentException('Tape does not have Tv Show');
        }
        $tvShow->setFinished($finished);

        $this->entityManager->persist($tvShow);
        $this->entityManager->flush();

        return $tvShow;
    }

    /**
     * @param array $args
     * @return TvShow
     * @throws InvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(array $args): TvShow
    {
        return $this->execute($args['input']);
    }
}
