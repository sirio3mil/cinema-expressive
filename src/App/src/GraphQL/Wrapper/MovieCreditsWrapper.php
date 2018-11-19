<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:06
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Mapper\CastMapper;

class MovieCreditsWrapper extends AbstractPageWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new CastMapper());
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