<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:21
 */

namespace App\GraphQL\Factory;

use App\GraphQL\TypeRegistry;
use App\GraphQL\Resolver\MovieDetailResolver;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class MovieDetailFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => $typeRegistry->get('movie'),
            'args' => [
                'tapeId' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return MovieDetailResolver::resolve($container, $args);
            }
        ];
    }
}