<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 12:23
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Mapper\ReleaseMapper;

class MovieReleasesWrapper extends AbstractPageWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new ReleaseMapper());
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