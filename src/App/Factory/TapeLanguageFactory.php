<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 14:41
 */

namespace App\Factory;

use App\Entity\Language;
use App\Entity\Tape;
use App\Resolver\TapeLanguageResolver;
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
                'tapeId' => $types->getId(Tape::class),
            ],
            'resolve' => function ($source, $args) {
                return TapeLanguageResolver::resolve($args);
            }
        ];
    }
}