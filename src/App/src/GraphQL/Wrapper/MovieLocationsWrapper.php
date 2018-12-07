<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:04
 */

namespace App\GraphQL\Wrapper;


use GraphQL\Type\Definition\Type;
use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Model\Location;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\TypeRegistry;

class MovieLocationsWrapper extends AbstractPageWrapper
{

    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new LocationMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = Type::listOf($typeRegistry->get('location'));
        $this->args = [
            'imdbNumber' => Type::nonNull(Type::int()),
        ];
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