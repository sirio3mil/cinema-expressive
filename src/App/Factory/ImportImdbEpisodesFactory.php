<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:43
 */

namespace App\Factory;

use App\Entity\TvShowChapter;
use App\Resolver\ImportImdbEpisodesResolver;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImportImdbEpisodesFactory
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
            'type' => Type::listOf($types->getOutput(TvShowChapter::class)),
            'resolve' => function ($source, $args) use ($container) {
                return ImportImdbEpisodesResolver::resolve($container, $args);
            }
        ];
    }
}