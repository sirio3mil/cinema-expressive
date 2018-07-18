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
    
    /** @var AbstractPageMapper $scrapper */
    protected $scrapper;
    
    public function __construct()
    {
        $this->setScrapper(new HomeMapper());
    }

    /**
     * @param $scrapper
     */
    public function setScrapper(AbstractPageMapper $scrapper): void
    {
        $this->scrapper = $scrapper;
    }

    /**
     * @return AbstractPageMapper
     */
    public function getScrapper(): AbstractPageMapper
    {
        return $this->scrapper;
    }

    /**
     * @param int $imdbNumber
     * @return array
     * @throws \Exception
     */
    public function getData(int $imdbNumber): array
    {
        $this->scrapper->setImdbNumber($imdbNumber)->setContentFromUrl();
        return [
            'year' => $this->scrapper->getYear(),
            'title' => $this->scrapper->getTitle(),
            'languages' => $this->scrapper->getLanguages(),
            'duration' => $this->scrapper->getDuration(),
            'color' => $this->scrapper->getColor(),
            'recommendations' => $this->scrapper->getRecommendations(),
            'countries' => $this->scrapper->getCountries(),
            'tvShow' => $this->scrapper->getTvShow(),
            'haveReleaseInfo' => $this->scrapper->haveReleaseInfo(),
            'isTvShow' => $this->scrapper->isTvShow(),
            'isEpisode' => $this->scrapper->isEpisode(),
            'genres' => $this->scrapper->getGenres(),
            'sounds' => $this->scrapper->getSounds(),
            'score' => $this->scrapper->getScore(),
            'votes' => $this->scrapper->getVotes(),
            'imdbNumber' => $imdbNumber
        ];
    }
}