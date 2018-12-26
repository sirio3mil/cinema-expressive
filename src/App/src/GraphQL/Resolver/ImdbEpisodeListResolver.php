<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 18:02
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Model\Episode;
use Psr\Container\ContainerInterface;

class ImdbEpisodeListResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        $data = [];
        /** @var EpisodeListMapper $mapper */
        $mapper = $container->get(EpisodeListMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setSeason($args['seasonNumber'])->setContentFromUrl();
        /** @var EpisodeIterator $episodeIterator */
        $episodeIterator = $mapper->getEpisodes();
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