<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:39
 */

namespace App\GraphQL\Factory;

use App\GraphQL\TypeRegistry;
use App\GraphQL\Resolver\ImdbMovieLocationResolver;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImdbMovieLocationFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => Type::listOf($typeRegistry->get('location')),
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return ImdbMovieLocationResolver::resolve($container, $args);
            }
        ];
    }
}