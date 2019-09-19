<?php


namespace App\Resolver;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use function count;
use function ceil;

trait ListOutputTrait
{

    /**
     * @var QueryBuilder
     */
    private $qb;

    protected function getOutput(int $page, int $pageSize): array
    {
        $paginator = new Paginator($this->qb);
        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page - 1))
            ->setMaxResults($pageSize);

        return [
            'elements' => $paginator->getIterator(),
            'total' => $totalItems,
            'pages' => $pagesCount
        ];
    }
}
