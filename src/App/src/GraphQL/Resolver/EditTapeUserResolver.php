<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 12:36
 */

namespace App\GraphQL\Resolver;


use App\Entity\ImdbNumber;
use App\Entity\RowType;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\GraphQL\TypeRegistry;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\Query;

class EditTapeUserResolver
{
    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {

        /** @var ContainerInterface $container */
        $container = $typeRegistry->getContainer();

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        if(empty($args['tapeId'])){
            if(empty($args['imdbNumber'])) {
                throw new \InvalidArgumentException('Undefined Tape');
            }

            /** @var RowType $tapeRowType */
            $tapeRowType = $entityManager->getRepository(RowType::class)->findOneBy([
                "rowTypeId" => RowType::ROW_TYPE_TAPE
            ]);
            /** @var Query $query */
            $query = $entityManager->createQuery('SELECT i FROM App\Entity\ImdbNumber i JOIN i.object o WHERE i.imdbNumber = :imdbNumber AND o.rowType = :rowType');
            $query->setParameters([
                'imdbNumber' => $args['imdbNumber'],
                'rowType' => $tapeRowType
            ]);
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $query->getSingleResult();
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                "object" => $imdbNumber->getObject()
            ]);
        }
        else{
            /** @var Tape $tape */
            $tape = $entityManager->getRepository(Tape::class)->find($args['tapeId']);
        }

        if(!$tape){
            throw new \InvalidArgumentException('Tape not found');
        }

        /** @var User $user */
        $user = $entityManager->getRepository(User::class)->find($args['userId']);

        if(!$user){
            throw new \InvalidArgumentException('User not found');
        }

        /** @var TapeUserStatus $tapeUserStatus */
        $tapeUserStatus = $entityManager->getRepository(TapeUserStatus::class)->find($args['tapeUserStatusId']);

        if(!$tapeUserStatus){
            throw new \InvalidArgumentException('Tape user status not found');
        }

        /** @var Query $query */
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\TapeUser i WHERE i.tape = :tape AND i.user = :user');
        $query->setParameters([
            'tape' => $tape,
            'user' => $user
        ]);
        /** @var TapeUser $tapeUser */
        $tapeUser = $query->getOneOrNullResult();
        if(!$tapeUser){
            $tapeUser = new TapeUser();
            $tapeUser->setTape($tape);
            $tapeUser->setUser($user);
            $entityManager->persist($tapeUser);
            $entityManager->flush();
        }

        /** @var Query $query */
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\TapeUserHistory i WHERE i.tapeUser = :tapeUser AND i.tapeUserStatus = :tapeUserStatus');
        $query->setParameters([
            'tapeUser' => $tapeUser,
            'tapeUserStatus' => $tapeUserStatus
        ]);
        /** @var TapeUserHistory $tapeUserHistory */
        $tapeUserHistory = $query->getOneOrNullResult();
        if(!$tapeUserHistory){
            $tapeUserHistory = new TapeUserHistory();
            $tapeUserHistory->setTapeUser($tapeUser);
            $tapeUserHistory->setTapeUserStatus($tapeUserStatus);
            $entityManager->persist($tapeUserHistory);
            $entityManager->flush();
        }

        if(!empty($args['place'])){

            /** @var Query $query */
            $query = $entityManager->createQuery('SELECT i FROM App\Entity\TapeUserHistoryDetail i WHERE i.tapeUserHistory = :tapeUserHistory');
            $query->setParameters([
                'tapeUserHistory' => $tapeUserHistory
            ]);
            /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
            $tapeUserHistoryDetail = $query->getOneOrNullResult();
            if(!$tapeUserHistoryDetail){
                $tapeUserHistoryDetail = new TapeUserHistoryDetail();
                $tapeUserHistoryDetail->setTapeUserHistory($tapeUserHistory);
                $tapeUserHistoryDetail->setPlace($args['place']);
                $entityManager->persist($tapeUserHistoryDetail);
                $entityManager->flush();
            }
        }

        return [
            'tapeUserId' => $tapeUser->getTapeUserId(),
            'tapeUserHistoryId' => $tapeUserHistory->getTapeUserHistoryId()
        ];
    }
}