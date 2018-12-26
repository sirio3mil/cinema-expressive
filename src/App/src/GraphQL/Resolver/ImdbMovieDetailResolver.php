<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 13:18
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\HomeMapper;
use Psr\Container\ContainerInterface;

class ImdbMovieDetailResolver
{
    
    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var HomeMapper $mapper */
        $mapper = $container->get(HomeMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        return [
            'year' => $mapper->getYear(),
            'title' => $mapper->getTitle(),
            'languages' => $mapper->getLanguages(),
            'duration' => $mapper->getDuration(),
            'color' => $mapper->getColor(),
            'recommendations' => $mapper->getRecommendations(),
            'countries' => $mapper->getCountries(),
            'tvShow' => $mapper->getTvShow(),
            'haveReleaseInfo' => $mapper->haveReleaseInfo(),
            'isTvShow' => $mapper->isTvShow(),
            'isEpisode' => $mapper->isEpisode(),
            'genres' => $mapper->getGenres(),
            'sounds' => $mapper->getSounds(),
            'score' => $mapper->getScore(),
            'votes' => $mapper->getVotes(),
            'episodeNumber' => $mapper->getEpisodeNumber(),
            'seasonNumber' => $mapper->getSeasonNumber(),
            'seasons' => $mapper->getSeasons(),
            'imdbNumber' => $args['imdbNumber']
        ];
    }
}