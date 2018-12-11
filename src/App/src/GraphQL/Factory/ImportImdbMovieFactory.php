<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:40
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ImportImdbMovieResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImportImdbMovieFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int())
            ],
            'type' => $typeRegistry->get('importImdbMovieOutput'),
            'resolve' => function ($source, $args) use ($container) {
                return ImportImdbMovieResolver::resolve($container, $args);
            }
        ];
    }
}