<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 14:43
 */

namespace App\GraphQL\Resolver;


use App\Entity\Tape;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class TapeLanguageResolver
{
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var Tape $tape */
        $tape = $entityManager->getRepository(Tape::class)->find($args['tapeId']);
        if (!$tape) {
            throw new \InvalidArgumentException('Tape not found');
        }
        return $tape->getLanguages()->toArray();
    }
}