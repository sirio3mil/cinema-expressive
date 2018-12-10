<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/12/2018
 * Time: 15:54
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Service\SearchService;
use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class SearchFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var TypeRegistry $typeRegistry */
        $typeRegistry = $container->get(TypeRegistry::class);

        return [
            'type' => Type::listOf($typeRegistry->get('searchResult')),
            'args' => [
                'pattern' => Type::nonNull(Type::string())
            ],
            'resolve' => function ($source, $args) use ($container) {
                return SearchService::resolve($container, $args);
            }
        ];
    }
}