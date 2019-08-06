<?php

namespace App\GraphQL\Factory;

use App\Entity\Place;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\GraphQL\Resolver\ListTapeUserResolver;
use App\GraphQL\Type\TapeUserPageType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;
use GraphQL\Doctrine\Exception;

class ListTapeUserFactory
{
    /**
     * @param ContainerInterface $container
     * @return array
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => $types->get(TapeUserPageType::class),
            'args' => [
                'userId' => Type::nonNull($types->getId(User::class)),
                'tapeUserStatusId' => $types->getId(TapeUserStatus::class),
                'isTvShow' => Type::boolean(),
                'visible' => Type::boolean(),
                'placeId' => $types->getId(Place::class),
                'page' => Type::nonNull(Type::int()),
                'pageSize' => Type::nonNull(Type::int())
            ],
            'resolve' => function ($source, $args) use ($container) {
                /** @var EntityManager $entityManager */
                $entityManager = $container->get(EntityManager::class);
                /** @var QueryBuilder $queryBuilder */
                $queryBuilder = $entityManager->createQueryBuilder();
                return ListTapeUserResolver::resolve($queryBuilder, $args);
            }
        ];
    }
}