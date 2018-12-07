<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 19/11/2018
 * Time: 16:40
 */

namespace App\GraphQL\Wrapper;

use App\Entity\GlobalUniqueObject;
use App\Entity\ImdbNumber;
use App\Entity\People;
use App\Entity\RowType;
use App\Entity\Tape;
use App\GraphQL\TypeRegistry;
use Doctrine\ORM\EntityManager;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class SearchWrapper extends AbstractWrapper
{

    /** @var Adapter */
    protected $adapter;

    /** @var EntityManager */
    protected $entityManager;

    public function __construct(Adapter $adapter, EntityManager $entityManager, AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->adapter = $adapter;
        $this->entityManager = $entityManager;
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = Type::listOf($typeRegistry->get('searchResult'));
        $this->args = [
            'pattern' => Type::nonNull(Type::string())
        ];
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function getData(array $args): array
    {
        $sql = "exec dbo.SearchParam ?";
        /** @var ResultSet $stmt */
        $stmt = $this->adapter->query($sql, [
            $args['pattern']
        ]);

        $results = [];

        foreach ($stmt as $row) {
            /** @var GlobalUniqueObject $object */
            $object = $this->entityManager->getRepository(GlobalUniqueObject::class)->findOneBy([
                "objectId" => $row->objectId
            ]);
            $internalId = null;
            $rowType = $object->getRowType();
            $rowTypeId = $rowType->getRowTypeId();
            /** @var ImdbNumber $imdbNumber */
            $imdbNumber = $this->entityManager->getRepository(ImdbNumber::class)->findOneBy([
                "object" => $object
            ]);
            $original = null;
            switch ($rowTypeId) {
                case RowType::ROW_TYPE_PEOPLE:
                    /** @var People $person */
                    $person = $this->entityManager->getRepository(People::class)->findOneBy([
                        "object" => $object
                    ]);
                    $internalId = $person->getPeopleId();
                    $original = $person->getFullName();
                    break;
                case RowType::ROW_TYPE_TAPE:
                    /** @var Tape $tape */
                    $tape = $this->entityManager->getRepository(Tape::class)->findOneBy([
                        "object" => $object
                    ]);
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