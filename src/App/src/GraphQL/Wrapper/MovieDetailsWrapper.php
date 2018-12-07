<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 13:18
 */

namespace App\GraphQL\Wrapper;


use App\GraphQL\TypeRegistry;
use ImdbScraper\Mapper\HomeMapper;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use GraphQL\Type\Definition\Type;

class MovieDetailsWrapper extends AbstractPageWrapper
{
    
    public function __construct(AbstractAdapter $cacheStorageAdapter, TypeRegistry $typeRegistry)
    {
        $this->setPageMapper(new HomeMapper());
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        $this->type = $typeRegistry->get('movie');
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
            'episodeNumber' => $this->pageMapper->getEpisodeNumber(),
            'seasonNumber' => $this->pageMapper->getSeasonNumber(),
            'seasons' => $this->pageMapper->getSeasons(),
            'imdbNumber' => $args['imdbNumber']
        ];
    }
}