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
use App\Entity\Place;
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

        /** @var User|null $user */
        $user = null;
        if (array_key_exists('userId', $args) && filter_var($args['userId'], FILTER_VALIDATE_INT)) {
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
            $imdbNumber = $object->getImdbNumber();
            $original = null;
            $userObject = [];
            switch ($rowTypeId) {
                case RowType::ROW_TYPE_PEOPLE:
                    /** @var People $person */
                    $person = $object->getPeople();
                    $internalId = $person->getPeopleId();
                    $original = $person->getFullName();
                    break;
                case RowType::ROW_TYPE_TAPE:
                    /** @var Tape $tape */
                    $tape = $object->getTape();
                    $internalId = $tape->getTapeId();
                    $original = $tape->getOriginalTitle();
                    if ($user) {
                        /** @var TapeUser $tapeUser */
                        $tapeUser = $entityManager->getRepository(TapeUser::class)->findOneBy([
                            "user" => $user,
                            "tape" => $tape
                        ]);
                        if ($tapeUser) {
                            $userObject['objectUserId'] = $tapeUser->getTapeUserId();
                            /** @var TapeUserScore $tapeScore */
                            $tapeScore = $tapeUser->getScore();
                            if ($tapeScore) {
                                $userObject['score'] = $tapeScore->getScore();
                                $userObject['scoreDate'] = $tapeScore->getCreatedAt()->format("d/m/Y");
                            }
                            /** @var TapeUserHistory[] $history */
                            $history = $tapeUser->getHistory();
                            if ($history) {
                                $items = [];
                                /** @var TapeUserHistory $row */
                                foreach ($history as $row) {
                                    $item = [];
                                    $item['statusId'] = $row->getTapeUserStatus()->getTapeUserStatusId();
                                    $item['status'] = $row->getTapeUserStatus()->getStatusDescription();
                                    $item['date'] = $row->getCreatedAt()->format("d/m/Y");
                                    /** @var TapeUserHistoryDetail $tapeUserHistoryDetail */
                                    $tapeUserHistoryDetail = $row->getDetail();
                                    if ($tapeUserHistoryDetail) {
                                        $details = [];
                                        $details['date'] = $tapeUserHistoryDetail->getCreatedAt()->format("d/m/Y");
                                        $details['visible'] = $tapeUserHistoryDetail->getVisible();
                                        $details['exported'] = $tapeUserHistoryDetail->getExported();
                                        /** @var Place $place */
                                        $place = $tapeUserHistoryDetail->getPlace();
                                        if ($place) {
                                            $details['placeId'] = $place->getPlaceId();
                                            $details['place'] = $place->getDescription();
                                        }
                                        $item['details'] = $details;
                                    }
                                    $items[] = $item;
                                }
                                $userObject['history'] = $items;
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