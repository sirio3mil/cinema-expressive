<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:25
 */

namespace App\GraphQL\Factory;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Resolver\MovieCastResolver;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class MovieCastFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => $typeRegistry->get('credits'),
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return MovieCastResolver::resolve($container, $args);
            }
        ];
    }
}