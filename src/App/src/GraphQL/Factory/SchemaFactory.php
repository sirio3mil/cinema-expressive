<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:48
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Type\Mutation;
use App\GraphQL\Type\Query;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Psr\Container\ContainerInterface;

class SchemaFactory
{
    public function __invoke(ContainerInterface $container): Schema
    {
        $config = SchemaConfig::create()
            ->setQuery($container->get(Query::class))
            ->setMutation($container->get(Mutation::class));
        return new Schema($config);
    }
}