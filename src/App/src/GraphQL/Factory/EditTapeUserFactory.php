<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:38
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\EditTapeUserResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class EditTapeUserFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'args' => [
                'userId' => Type::nonNull(Type::int()),
                'imdbNumbers' => Type::listOf(Type::int()),
                'tapeIds' => Type::listOf(Type::int()),
                'tapeUserStatusId' => Type::nonNull(Type::int()),
                'placeId' => Type::int()
            ],
            'type' => Type::listOf($typeRegistry->get('tapeUser')),
            'resolve' => function ($source, $args) use ($container) {
                return EditTapeUserResolver::resolve($container, $args);
            }
        ];
    }
}