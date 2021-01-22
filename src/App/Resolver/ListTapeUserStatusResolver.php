<?php

namespace App\Resolver;

use App\Entity\TapeUserStatus;
use Doctrine\ORM\EntityManager;
use Exception;
use GraphQL\Doctrine\Annotation as API;
use JetBrains\PhpStorm\ArrayShape;

class ListTapeUserStatusResolver extends AbstractResolver implements QueryResolverInterface
{

    use ListOutputTrait;

    public function __construct(EntityManager $entityManager)
    {
        $this->qb = $entityManager->createQueryBuilder();
    }

    /**
     * @API\Field(type="TapeUserStatusPageType")
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['elements' => "\ArrayIterator", 'total' => "int", 'pages' => "false|float"])]
    protected function execute(int $page, int $pageSize): array
    {
        $this->qb->select('o')->from(TapeUserStatus::class, 'o');

        return $this->getOutput($page, $pageSize);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    #[ArrayShape(['elements' => "\ArrayIterator", 'total' => "int", 'pages' => "false|float"])]
    public function resolve(array $args)
    {
        return $this->execute(
            $args['page'],
            $args['pageSize']
        );
    }
}
