<?php

namespace App\Resolver;

use App\Entity\TapeUserStatus;
use Doctrine\ORM\EntityManager;
use Exception;
use GraphQL\Doctrine\Annotation as API;

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
    protected function execute(int $page, int $pageSize): array
    {
        $this->qb->select('o')->from(TapeUserStatus::class, 'o');

        return $this->getOutput($page, $pageSize);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function resolve(array $args)
    {
        return $this->execute(
            $args['page'],
            $args['pageSize']
        );
    }
}
