<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 27/12/2018
 * Time: 16:10
 */

namespace App\Factory;

use Doctrine\ORM\EntityManager;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TypeFactory
{
    public function __invoke(ContainerInterface $container): Types
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return new Types($entityManager, $container);
    }
}