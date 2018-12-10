<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:23
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\ReleaseMapper;
use Psr\Container\ContainerInterface;

class MovieReleaseResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function getData(ContainerInterface $container, array $args): array
    {
        /** @var ReleaseMapper $mapper */
        $mapper = $container->get(ReleaseMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        return [
            'titles' => $mapper->getAlsoKnownAs(),
            'dates' => $mapper->getReleaseDates()
        ];
    }
}