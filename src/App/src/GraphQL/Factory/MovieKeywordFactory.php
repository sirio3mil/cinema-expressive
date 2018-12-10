<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:36
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\MovieKeywordResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class MovieKeywordFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => $typeRegistry->get('keywords'),
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return MovieKeywordResolver::resolve($container, $args);
            }
        ];
    }
}