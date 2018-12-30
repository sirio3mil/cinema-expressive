<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:38
 */

namespace App\GraphQL\Factory;

use App\Entity\TapeUser;
use App\GraphQL\Resolver\EditTapeUserResolver;
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
            'type' => Type::listOf($types->getOutput(TapeUser::class)),
            'args' => [
                'userId' => Type::nonNull(Type::int()),
                'imdbNumbers' => Type::listOf(Type::int()),
                'tapeIds' => Type::listOf(Type::int()),
                'tapeUserStatusId' => Type::nonNull(Type::int()),
                'placeId' => Type::int()
            ],
            'resolve' => function ($source, $args) use ($container) {
                return EditTapeUserResolver::resolve($container, $args);
            }
        ];
    }
}