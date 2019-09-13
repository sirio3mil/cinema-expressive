<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:38
 */

namespace App\Factory;

use App\Entity\Place;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\Resolver\EditTapeUserResolver;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class EditTapeUserFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => Type::nonNull($types->getOutput(TapeUser::class)),
            'args' => [
                'userId' => Type::nonNull($types->getId(User::class)),
                'tapeId' => Type::nonNull($types->getId(Tape::class)),
                'tapeUserStatusId' => Type::nonNull($types->getId(TapeUserStatus::class)),
                'placeId' => $types->getId(Place::class)
            ],
            'resolve' => function ($source, $args) use ($container) {
                /** @var EntityManager $entityManager */
                $entityManager = $container->get(EntityManager::class);
                return EditTapeUserResolver::resolve($entityManager, $args);
            }
        ];
    }
}