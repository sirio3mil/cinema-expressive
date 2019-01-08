<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/12/2018
 * Time: 15:54
 */

namespace App\GraphQL\Factory;

use App\Entity\SearchValue;
use App\GraphQL\Resolver\SearchResolver;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class SearchFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => Type::listOf($types->getOutput(SearchValue::class)),
            'args' => [
                'pattern' => Type::nonNull(Type::string()),
                'rowType' => Type::int()
            ],
            'resolve' => function ($source, $args) use ($container) {
                return SearchResolver::resolve($container, $args);
            }
        ];
    }
}