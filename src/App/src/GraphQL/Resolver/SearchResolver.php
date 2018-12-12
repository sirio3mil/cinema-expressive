<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/12/2018
 * Time: 15:02
 */

namespace App\GraphQL\Resolver;


use App\Entity\GlobalUniqueObject;
use App\Entity\ImdbNumber;
use App\Entity\People;
use App\Entity\RowType;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserHistory;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserScore;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class SearchResolver
{
    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var Adapter $adapter */
        $adapter = $container->get(Adapter::class);
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        $userLogged = filter_var($args['userId'], FILTER_VALIDATE_INT);
        /** @var User|null $user */
        $user = null;
        if ($userLogged){
            $user = $entityManager->getRepository(User::class)->findOneBy([
                "userId" => $args['userId']
            ]);
        }

        $sql = "exec dbo.SearchParam ?";
        /** @var ResultSet $stmt */
        $stmt = $adapter->query($sql, [
            $args['pattern']
        ]);

        $results = [];

        foreach ($stmt as $row) {
            /** @var GlobalUniqueObject $object */
            $object = $entityManager->getRepository(GlobalUniqueObject::class)->findOneBy([
                "objectId" => $row->objectId
            ]);
            $internalId = null;
            $rowType = $object->getRowType();
            $rowTypeId = $rowType->getRowTypeId();
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $entityManager->getRepository(ImdbNumber::class)->findOneBy([
                "object" => $object
            ]);
            $original = null;
            $userObject = [];
            switch ($rowTypeId) {
                case RowType::ROW_TYPE_PEOPLE:
                    /** @var People $person */
                    $person = $entityManager->getRepository(People::class)->findOneBy([
                        "object" => $object
                    ]);
                    $internalId = $person->getPeopleId();
                    $original = $person->getFullName();
                    break;
                case RowType::ROW_TYPE_TAPE:
                    /** @var Tape $tape */
                    $tape = $entityManager->getRepository(Tape::class)->findOneBy([
                        "object" => $object
                    ]);
                    $internalId = $tape->getTapeId();
                    $original = $tape->getOriginalTitle();
                    if($user){
                        /** @var TapeUser $tapeUser */
                        $tapeUser = $entityManager->getRepository(TapeUser::class)->findOneBy([
                            "user" => $user,
                            "tape" => $tape
                        ]);
                        if($tapeUser) {
                            $userObject['objectUserId'] = $tapeUser->getTapeUserId();
                            /** @var TapeUserScore $tapeScore */
                            $tapeScore = $entityManager->getRepository(TapeUserScore::class)->findOneBy([
                                "tapeUser" => $tapeUser
                            ]);
                            if($tapeScore){
                                $userObject['score'] = $tapeScore->getScore();
                                $userObject['scoreDate'] = $tapeScore->getCreatedAt()->format("d/m/Y");
                            }
                            /** @var TapeUserHistory[] $tapeUserHistories */
                            $tapeUserHistories = $entityManager->getRepository(TapeUserHistory::class)->findBy([
                                "tapeUser" => $tapeUser
                            ]);
                            if($tapeUserHistories){
                                $histories = [];
                                /** @var TapeUserHistory $tapeUserHistory */
                                foreach ($tapeUserHistories as $tapeUserHistory){
                                    $histories['statusId'] = $tapeUserHistory->getTapeUserStatus()->getTapeUserStatusId();
                                    $histories['status'] = $tapeUserHistory->getTapeUserStatus()->getStatusDescription();
                                    $details = [];
                                    /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
                                    $tapeUserHistoryDetail = $entityManager->getRepository(TapeUserHistoryDetail::class)->findOneBy([
                                        "tapeUserHistory" => $tapeUserHistory
                                    ]);
                                    $details['date'] = $tapeUserHistoryDetail->getCreatedAt()->format("d/m/Y");
                                    $details['placeId'] = $tapeUserHistoryDetail->getPlace()->getPlaceId();
                                    $details['visible'] = $tapeUserHistoryDetail->getVisible();
                                    $details['exported'] = $tapeUserHistoryDetail->getExported();
                                    $details['place'] = $tapeUserHistoryDetail->getPlace()->getDescription();
                                    $histories['details'] = $details;
                                }
                                $userObject['history'] = $histories;
                            }
                        }
                    }
                    break;
            }

            $results[] = [
                'searchParam' => $row->searchParam,
                'objectId' => $row->objectId,
                'rowTypeId' => $rowTypeId,
                'rowType' => $rowType->getDescription(),
                'internalId' => $internalId,
                'imdbNumber' => $imdbNumber ? $imdbNumber->getImdbNumber() : 0,
                'original' => $original,
                'userObject' => $userObject
            ];
        }

        return $results;
    }
}