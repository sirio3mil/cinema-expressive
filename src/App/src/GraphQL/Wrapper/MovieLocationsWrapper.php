<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:04
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Model\Location;

class MovieLocationsWrapper extends AbstractWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new LocationMapper());
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function getData(array $args): array
    {
        $data = [];
        $this->pageMapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        /** @var LocationIterator $locations */
        $locations = $this->pageMapper->getLocations();
        /** @var Location $location */
        foreach ($locations as $location){
            $data[] = [
                'location' => $location->getLocation(),
                'totalVotes' => $location->getTotalVotes(),
                'relevantVotes' => $location->getRelevantVotes()
            ];
        }
        return $data;
    }
}