<?php

namespace App\Factory;

use App\Type\PlacePageType;
use App\Type\TapeUserPageType;
use App\Type\TypeContainer;
use DateTime;
use Psr\Container\ContainerInterface;

class TypeContainerFactory
{
    public function __invoke(ContainerInterface $container): TypeContainer
    {
        return new TypeContainer([
            DateTime::class => static function (ContainerInterface $container) {
                return $container->get(DateTime::class);
            },
            TapeUserPageType::class => static function (ContainerInterface $container) {
                return $container->get(TapeUserPageType::class);
            },
            PlacePageType::class => static function (ContainerInterface $container) {
                return $container->get(PlacePageType::class);
            }
        ], $container);
    }
}
