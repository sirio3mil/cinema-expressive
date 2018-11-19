<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 13:01
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Mapper\KeywordMapper;

class MovieKeywordsWrapper extends AbstractPageWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new KeywordMapper());
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