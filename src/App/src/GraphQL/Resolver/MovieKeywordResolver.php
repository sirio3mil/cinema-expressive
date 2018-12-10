<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 13:01
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\KeywordMapper;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\Type;

class MovieKeywordResolver
{

    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new KeywordMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = $typeRegistry->get('keywords');
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
            'total' => $this->pageMapper->getTotalKeywords(),
            'keywords' => $this->pageMapper->getKeywords()
        ];
    }
}