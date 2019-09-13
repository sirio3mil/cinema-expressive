<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/12/2018
 * Time: 15:02
 */

namespace App\Resolver;

use App\Entity\GlobalUniqueObject;
use App\Entity\RowType;
use App\Entity\SearchValue;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use GraphQL\Doctrine\Annotation as API;

class SearchResolver implements QueryResolverInterface
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
     * @API\Field(type="SearchValue[]")
     *
     * @param string $pattern
     * @param int|null $rowType
     * @return SearchValue[]
     */
    protected function execute(string $pattern, ?int $rowType): array
    {
        /** @var ResultSetMappingBuilder $rsm */
        $rsm = new ResultSetMappingBuilder($this->entityManager);
        $rsm->addRootEntityFromClassMetadata(SearchValue::class, 'sv');
        $rsm->addJoinedEntityFromClassMetadata(GlobalUniqueObject::class, 'o', 'sv', 'object');
        $rsm->addJoinedEntityFromClassMetadata(RowType::class, 'rt', 'o', 'rowType');

        $sql = "select sv.searchValueId
                    ,sv.searchParam
                    ,sv.primaryParam
                    ,o.objectId
                    ,rt.rowTypeId
                    ,rt.description
                from dbo.search (?, ?) s
                INNER JOIN dbo.SearchValue sv on sv.searchValueId = s.searchValueId
                INNER JOIN dbo.Object o on o.objectId = sv.objectId
                INNER JOIN dbo.RowType rt on rt.rowTypeId = o.rowTypeId";
        /** @var NativeQuery $query */
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $pattern);
        $query->setParameter(2, $rowType);

        return $query->getResult();
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function resolve(array $args): array
    {
        return $this->execute($args['pattern'], $args['rowType'] ?? null);
    }
}
