<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:06
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\CastMapper;
use Psr\Container\ContainerInterface;

class ImdbMovieCastResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var CastMapper $mapper */
        $mapper = $container->get(CastMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        return [
            'cast' => $mapper->getCast(),
            'writers' => $mapper->getWriters(),
            'directors' => $mapper->getDirectors()
        ];
    }
}