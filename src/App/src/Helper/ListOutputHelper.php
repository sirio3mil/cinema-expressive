<?php


namespace App\Helper;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use function count;
use function ceil;

abstract class ListOutputHelper
{
    public static function getType(QueryBuilder $qb, array $args): array
    {
        $paginator = new Paginator($qb);

        $totalItems = count($paginator);
        $pageSize = $args['pageSize'];

        $pagesCount = ceil($totalItems / $pageSize);

        $currentPage = $args['page'];
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage - 1))
            ->setMaxResults($pageSize);

        return [
            'elements' => $paginator->getIterator(),
            'total' => $totalItems,
            'pages' => $pagesCount
        ];
    }
}
