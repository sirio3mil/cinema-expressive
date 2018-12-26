<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:04
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Model\Location;
use Psr\Container\ContainerInterface;

class ImdbMovieLocationResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        $data = [];
        /** @var LocationMapper $mapper */
        $mapper = $container->get(LocationMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        /** @var LocationIterator $locations */
        $locations = $mapper->getLocations();
        if ($locations->getIterator()->count()) {
            /** @var Location $location */
            foreach ($locations as $location) {
                $data[] = [
                    'location' => $location->getLocation(),
                    'totalVotes' => $location->getTotalVotes(),
                    'relevantVotes' => $location->getRelevantVotes()
                ];
            }
        }
        return $data;
    }
}