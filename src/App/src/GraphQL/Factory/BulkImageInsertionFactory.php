<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 02/01/2019
 * Time: 15:30
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\BulkImageInsertionResolver;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class BulkImageInsertionFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        return [
            'type' => Type::nonNull(Type::int()),
            'resolve' => function ($source, $args) use ($container) {
                return BulkImageInsertionResolver::resolve($container, $args);
            }
        ];
    }
}