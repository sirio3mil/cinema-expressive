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
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use GraphQL\Doctrine\Annotation as API;

class SearchResolver extends AbstractResolver implements QueryResolverInterface
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    /**
     * @API\Field(type="SearchValue[]")
     *
     * @param string $pattern
     * @param int $page
     * @param int $pageSize
     * @param int|null $rowType
     * @return SearchValue[]
     */
    protected function execute(string $pattern, int $page, int $pageSize, ?int $rowType): array
    {
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
                from dbo.search (?, ?, ?, ?) s
                INNER JOIN dbo.SearchValue sv on sv.searchValueId = s.searchValueId
                INNER JOIN dbo.Object o on o.objectId = sv.objectId
                INNER JOIN dbo.RowType rt on rt.rowTypeId = o.rowTypeId";
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $pattern);
        $query->setParameter(2, $rowType);
        $query->setParameter(3, $page);
        $query->setParameter(4, $pageSize);

        return $query->getResult();
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function resolve(array $args): array
    {
        $rowType = $args['rowType'] ?? null;
        return $this->execute(
            $args['pattern'],
            $args['page'],
            $args['pageSize'],
            $rowType
        );
    }
}
