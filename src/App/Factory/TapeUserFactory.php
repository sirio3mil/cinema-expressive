<?php

namespace App\Factory;

use App\Service\TapeUserService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class TapeUserFactory
{
    /**
     * @param ContainerInterface $container
     * @return TapeUserService
     */
    public function __invoke(ContainerInterface $container): TapeUserService
    {
        return new TapeUserService(
            $container->get(EntityManager::class)
        );
    }
}
