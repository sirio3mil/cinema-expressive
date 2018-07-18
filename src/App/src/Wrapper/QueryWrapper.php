<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 13:18
 */

namespace App\Wrapper;


use ImdbScraper\Mapper\AbstractPageMapper;
use ImdbScraper\Mapper\HomeMapper;

class QueryWrapper
{
    
    /** @var AbstractPageMapper $pageMapper */
    protected $pageMapper;
    
    public function __construct()
    {
        $this->setPageMapper(new HomeMapper());
    }

    /**
     * @param $pageMapper
     */
    public function setPageMapper(AbstractPageMapper $pageMapper): void
    {
        $this->pageMapper = $pageMapper;
    }

    /**
     * @return AbstractPageMapper
     */
    public function getPageMapper(): AbstractPageMapper
    {
        return $this->pageMapper;
    }

    /**
     * @param int $imdbNumber
     * @return array
     * @throws \Exception
     */
    public function getData(int $imdbNumber): array
    {
        $this->pageMapper->setImdbNumber($imdbNumber)->setContentFromUrl();
        return [
            'year' => $this->pageMapper->getYear(),
            'title' => $this->pageMapper->getTitle(),
            'languages' => $this->pageMapper->getLanguages(),
            'duration' => $this->pageMapper->getDuration(),
            'color' => $this->pageMapper->getColor(),
            'recommendations' => $this->pageMapper->getRecommendations(),
            'countries' => $this->pageMapper->getCountries(),
            'tvShow' => $this->pageMapper->getTvShow(),
            'haveReleaseInfo' => $this->pageMapper->haveReleaseInfo(),
            'isTvShow' => $this->pageMapper->isTvShow(),
            'isEpisode' => $this->pageMapper->isEpisode(),
            'genres' => $this->pageMapper->getGenres(),
            'sounds' => $this->pageMapper->getSounds(),
            'score' => $this->pageMapper->getScore(),
            'votes' => $this->pageMapper->getVotes(),
            'imdbNumber' => $imdbNumber
        ];
    }
}