<?php

namespace App\Factory;

use App\Type\TapeUserStatusPageType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TapeUserStatusPageTypeFactory
{
    /**
     * @param ContainerInterface $container
     * @return TapeUserStatusPageType
     */
    public function __invoke(ContainerInterface $container): TapeUserStatusPageType
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return new TapeUserStatusPageType($types);
    }
}
