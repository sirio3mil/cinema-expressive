<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:38
 */

namespace App\GraphQL\Factory;

use App\Entity\TvShow;
use App\GraphQL\Resolver\EditTvShowResolver;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class EditTvShowFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => Type::nonNull($types->getOutput(TvShow::class)),
            'args' => [
                'input' => Type::nonNull($types->getPartialInput(TvShow::class))
            ],
            'resolve' => function ($source, $args) use ($container) {
                /** @var EntityManager $entityManager */
                $entityManager = $container->get(EntityManager::class);
                return EditTvShowResolver::resolve($entityManager, $args);
            }
        ];
    }
}
