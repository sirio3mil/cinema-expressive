<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:40
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ImportImdbMovieResolver;
use App\GraphQL\Type\ImportImdbMovieOutputType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Definition\Type;

class ImportImdbMovieFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'args' => [
                'imdbNumber' => Type::nonNull(Type::int())
            ],
            'type' => $types->get(ImportImdbMovieOutputType::class),
            'resolve' => function ($source, $args) use ($container) {
                return ImportImdbMovieResolver::resolve($container, $args);
            }
        ];
    }
}