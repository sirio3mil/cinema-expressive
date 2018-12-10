<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:23
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\ReleaseMapper;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\Type;

class MovieReleaseResolver
{

    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new ReleaseMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = $typeRegistry->get('release');
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
        $this->pageMapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        return [
            'titles' => $this->pageMapper->getAlsoKnownAs(),
            'dates' => $this->pageMapper->getReleaseDates()
        ];
    }
}