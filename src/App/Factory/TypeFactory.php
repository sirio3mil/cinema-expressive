<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 27/12/2018
 * Time: 16:10
 */

namespace App\Factory;

use App\Type\TypeContainer;
use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TypeFactory
{
    public function __invoke(ContainerInterface $container): Types
    {
        return new Types($container->get(EntityManager::class), $container->get(TypeContainer::class));
    }
}