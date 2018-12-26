<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:21
 */

namespace App\GraphQL\Factory;

use App\Entity\Tape;
use App\GraphQL\Resolver\MovieDetailResolver;
use App\GraphQL\Type\MovieType;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class MovieDetailFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        $types = new Types($entityManager, $container);

        return [
            'type' => $types->getOutput(MovieType::class),
            'args' => [
                'tapeId' => $types->getId(Tape::class),
            ],
            'resolve' => function ($source, $args) {
                return MovieDetailResolver::resolve($args);
            }
        ];
    }
}