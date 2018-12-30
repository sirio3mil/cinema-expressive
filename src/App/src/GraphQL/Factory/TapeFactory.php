<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 12:21
 */

namespace App\GraphQL\Factory;

use App\Entity\Tape;
use App\GraphQL\Resolver\TapeResolver;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TapeFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return [
            'type' => $types->getOutput(Tape::class),
            'args' => [
                'tapeId' => $types->getId(Tape::class),
            ],
            'resolve' => function ($source, $args) {
                return TapeResolver::resolve($args);
            }
        ];
    }
}