<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 14:41
 */

namespace App\GraphQL\Factory;

use App\Entity\Language;
use App\GraphQL\Resolver\TapeLanguageResolver;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class TapeLanguageFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        $types = new Types($entityManager, $container);

        return [
            'type' => Type::listOf($types->getOutput(Language::class)),
            'args' => [
                'tapeId' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return TapeLanguageResolver::resolve($container, $args);
            }
        ];
    }
}