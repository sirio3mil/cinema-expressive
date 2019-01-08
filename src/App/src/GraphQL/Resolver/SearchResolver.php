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

        $sql = "exec dbo.SearchParam ?, ?";
        /** @var NativeQuery $query */
        $query = $entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $args['pattern']);
        $query->setParameter(2, $args['rowType']);

        return $query->getResult();
    }
}