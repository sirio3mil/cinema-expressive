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
use Psr\Container\ContainerInterface;

class SearchResolver
{
    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var ResultSetMappingBuilder $rsm */
        $rsm = new ResultSetMappingBuilder($entityManager);
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
        $query = $entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $args['pattern']);
        $query->setParameter(2, $args['rowType']);

        return $query->getResult();
    }
}