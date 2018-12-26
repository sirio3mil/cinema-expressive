<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:46
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ImdbEpisodeListResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImdbEpisodeListFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => Type::listOf($typeRegistry->get('episode')),
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
                'seasonNumber' => Type::int()
            ],
            'resolve' => function ($source, $args) use ($container) {
                return ImdbEpisodeListResolver::resolve($container, $args);
            }
        ];
    }
}