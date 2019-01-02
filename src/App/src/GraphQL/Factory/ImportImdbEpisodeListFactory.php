<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:43
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ImportImdbEpisodeListResolver;
use App\GraphQL\Type\ImportedEpisodeType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImportImdbEpisodeListFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int()),
                'seasonNumber' => Type::nonNull(Type::int())
            ],
            'type' => Type::listOf($types->get(ImportedEpisodeType::class)),
            'resolve' => function ($source, $args) use ($container) {
                return ImportImdbEpisodeListResolver::resolve($container, $args);
            }
        ];
    }
}