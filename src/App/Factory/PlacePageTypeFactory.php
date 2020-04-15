<?php

namespace App\Factory;

use App\Type\PlacePageType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class PlacePageTypeFactory
{
    /**
     * @param ContainerInterface $container
     * @return PlacePageType
     */
    public function __invoke(ContainerInterface $container): PlacePageType
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return new PlacePageType($types);
    }
}
