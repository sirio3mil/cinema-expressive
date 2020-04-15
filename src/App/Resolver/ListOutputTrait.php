<?php


namespace App\Resolver;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use function count;
use function ceil;

trait ListOutputTrait
{

    /**
     * @var QueryBuilder
     */
    protected $qb;

    /**
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws Exception
     */
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
