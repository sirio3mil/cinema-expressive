<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:48
 */

namespace App\Factory;

use App\Type\MutationType;
use App\Type\QueryType;
use GraphQL\Doctrine\DefaultFieldResolver;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Psr\Container\ContainerInterface;

class SchemaFactory
{
    public function __invoke(ContainerInterface $container): Schema
    {
        GraphQL::setDefaultFieldResolver(new DefaultFieldResolver());
        $config = SchemaConfig::create()
            ->setQuery($container->get(QueryType::class))
            ->setMutation($container->get(MutationType::class));
        return new Schema($config);
    }
}
