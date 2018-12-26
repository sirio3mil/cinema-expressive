<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 14:41
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\TapeLanguageResolver;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class TapeLanguageFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        return [
            'type' => Type::listOf(Type::string()),
            'args' => [
                'tapeId' => Type::nonNull(Type::int()),
            ],
            'resolve' => function ($source, $args) use ($container) {
                return TapeLanguageResolver::resolve($container, $args);
            }
        ];
    }
}