<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:48
 */

namespace App\Factory;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Psr\Container\ContainerInterface;

class SchemaFactory
{
    public function __invoke(ContainerInterface $container): Schema
    {
        $typeRegistry = $container->get(TypeRegistry::class);
        $config = SchemaConfig::create()
            ->setQuery($typeRegistry->get('query'))
            ->setMutation($typeRegistry->get('mutation'));
        return new Schema($config);
    }
}