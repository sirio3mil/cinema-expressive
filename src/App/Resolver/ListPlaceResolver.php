<?php

namespace App\Resolver;

use App\Entity\Place;
use Doctrine\ORM\EntityManager;
use Exception;
use GraphQL\Doctrine\Annotation as API;

class ListPlaceResolver extends AbstractResolver implements QueryResolverInterface
{

    use ListOutputTrait;

    public function __construct(EntityManager $entityManager)
    {
        $this->qb = $entityManager->createQueryBuilder();
    }

    /**
     * @API\Field(type="PlacePageType")
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws Exception
     */
    protected function execute(int $page, int $pageSize): array
    {
        $this->qb->select('p')->from(Place::class, 'p');

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
