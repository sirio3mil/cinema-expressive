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
                    break;
            }

            $results[] = [
                'searchParam' => $row->searchParam,
                'objectId' => $row->objectId,
                'rowTypeId' => $rowTypeId,
                'rowType' => $rowType->getDescription(),
                'internalId' => $internalId,
                'imdbNumber' => $imdbNumber ? $imdbNumber->getImdbNumber() : 0,
                'original' => $original
            ];
        }

        return $results;
    }
}