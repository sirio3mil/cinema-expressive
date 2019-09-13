<?php

namespace App\Factory;

use App\Type\TapeUserPageType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TapeUserPageTypeFactory
{
    /**
     * @param ContainerInterface $container
     * @return TapeUserPageType
     */
    public function __invoke(ContainerInterface $container): TapeUserPageType
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return new TapeUserPageType($types);
    }
}