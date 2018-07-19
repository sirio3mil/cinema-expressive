<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 18:02
 */

namespace App\GraphQL\Wrapper;


use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Model\Episode;

class QueryGetEpisodeListWrapper extends AbstractWrapper
{

    public function __construct()
    {
        $this->setPageMapper(new EpisodeListMapper());
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public function getData(array $args): array
    {
        $data = [];
        $this->pageMapper->setImdbNumber($args['imdbNumber'])->setSeason($args['seasonNumber'])->setContentFromUrl();
        /** @var EpisodeIterator $episodeIterator */
        $episodeIterator = $this->pageMapper->getEpisodes();
        /** @var Episode $episode */
        foreach ($episodeIterator as $episode){
            $data[] = [
                'title' => $episode->getTitle(),
                'date' => $episode->getDate()->format("Y-m-d"),
                'imdbNumber' => $episode->getImdbNumber(),
                'episodeNumber' => $episode->getEpisodeNumber(),
                'isFullDate' => $episode->getIsFullDate()
            ];
        }
        return $data;
    }
}