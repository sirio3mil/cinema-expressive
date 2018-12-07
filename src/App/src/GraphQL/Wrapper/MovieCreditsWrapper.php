<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:06
 */

namespace App\GraphQL\Wrapper;


use App\GraphQL\TypeRegistry;
use ImdbScraper\Mapper\CastMapper;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use GraphQL\Type\Definition\Type;

class MovieCreditsWrapper extends AbstractPageWrapper
{

    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new CastMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = $typeRegistry->get('credits');
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
            'cast' => $this->pageMapper->getCast(),
            'writers' => $this->pageMapper->getWriters(),
            'directors' => $this->pageMapper->getDirectors()
        ];
    }
}