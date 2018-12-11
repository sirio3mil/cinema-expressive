<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:43
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ImportImdbEpisodeListResolver;
use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImportImdbEpisodeListFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
                'seasonNumber' => Type::nonNull(Type::int())
            ],
            'type' => Type::listOf($typeRegistry->get('importedEpisode')),
            'resolve' => function ($source, $args) use ($container) {
                return ImportImdbEpisodeListResolver::resolve($container, $args);
            }
        ];
    }
}