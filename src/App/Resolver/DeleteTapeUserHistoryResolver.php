<?php

namespace App\Resolver;

use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

class DeleteTapeUserHistoryResolver extends AbstractResolver
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param TapeUserHistory $tapeUserHistory
     * @return TapeUser
     * @throws ORMException
     */
    protected function execute(TapeUserHistory $tapeUserHistory): TapeUser
    {
        $tapeUserHistory->setDeletedAt(new DateTime());
        $this->entityManager->persist($tapeUserHistory);
        $this->entityManager->flush();

        return $tapeUserHistory->getTapeUser();
    }

    /**
     * @inheritDoc
     * @return TapeUser
     * @throws ORMException
     */
    public function resolve(array $args)
    {
        /** @var TapeUserHistory $tapeUserHistory */
        $tapeUserHistory = $args['tapeUserHistoryId']->getEntity();

        return $this->execute($tapeUserHistory);
    }
}
