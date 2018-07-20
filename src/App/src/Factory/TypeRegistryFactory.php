<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 11:05
 */

namespace App\Factory;


use App\GraphQL\TypeRegistry;
use Psr\Container\ContainerInterface;

class TypeRegistryFactory
{
    public function __invoke(ContainerInterface $container): TypeRegistry
    {
        return new TypeRegistry($container);
    }
}