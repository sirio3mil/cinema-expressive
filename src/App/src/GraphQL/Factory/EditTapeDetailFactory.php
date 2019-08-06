<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:38
 */

namespace App\GraphQL\Factory;

use App\Entity\Tape;
use App\Entity\TapeDetail;
use App\GraphQL\Resolver\EditTapeDetailResolver;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class EditTapeDetailFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => Type::nonNull($types->getOutput(TapeDetail::class)),
            'args' => [
                'tapeId' => Type::nonNull($types->getId(Tape::class)),
                'input' => $types->getPartialInput(TapeDetail::class)
            ],
            'resolve' => function ($source, $args) use ($container) {
                /** @var EntityManager $entityManager */
                $entityManager = $container->get(EntityManager::class);
                return EditTapeDetailResolver::resolve($entityManager, $args);
            }
        ];
    }
}