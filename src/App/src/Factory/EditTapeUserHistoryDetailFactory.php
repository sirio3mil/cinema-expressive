<?php


namespace App\Factory;

use App\Entity\Tape;
use App\Entity\TapeUserHistoryDetail;
use App\Entity\TapeUserStatus;
use App\Entity\User;
use App\Resolver\EditTapeUserHistoryDetailResolver;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class EditTapeUserHistoryDetailFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => Type::nonNull($types->getOutput(TapeUserHistoryDetail::class)),
            'args' => [
                'tapeId' => Type::nonNull($types->getId(Tape::class)),
                'userId' => Type::nonNull($types->getId(User::class)),
                'tapeUserStatusId' => Type::nonNull($types->getId(TapeUserStatus::class)),
                'input' => Type::nonNull($types->getPartialInput(TapeUserHistoryDetail::class))
            ],
            'resolve' => function ($source, $args) use ($container) {
                /** @var EntityManager $entityManager */
                $entityManager = $container->get(EntityManager::class);
                return EditTapeUserHistoryDetailResolver::resolve($entityManager, $args);
            }
        ];
    }
}
