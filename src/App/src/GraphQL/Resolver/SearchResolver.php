<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/12/2018
 * Time: 15:02
 */

namespace App\GraphQL\Resolver;

use App\Entity\SearchValue;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query\ResultSetMapping;
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
        /** @var ResultSetMapping $rsm */
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(SearchValue::class, 'sv');
        $rsm->addFieldResult('sv', 'searchValueId', 'searchValueId');
        $rsm->addFieldResult('sv', 'objectId', 'object');
        $rsm->addFieldResult('sv', 'searchParam', 'searchParam');
        $rsm->addFieldResult('sv', 'primaryParam', 'primaryParam');

        $sql = "select sv.searchValueId
                    ,sv.objectId
                    ,sv.searchParam
                    ,sv.primaryParam
                from dbo.search (?, ?) s
                INNER JOIN dbo.SearchValue sv on sv.searchValueId = s.searchValueId";
        /** @var NativeQuery $query */
        $query = $entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $args['pattern']);
        $query->setParameter(2, $args['rowType']);

        return $query->getResult();
    }
}