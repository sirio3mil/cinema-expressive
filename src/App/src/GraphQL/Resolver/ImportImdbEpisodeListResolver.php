<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\GraphQL\Resolver;


use Psr\Container\ContainerInterface;

class ImportImdbEpisodeListResolver
{

    protected static function importEpisodes(ContainerInterface $container, array $episodeList)
    {
        $episodes = [];

        foreach ($episodeList as $episode) {
            $result = ImportImdbMovieResolver::resolve($container, $episode);
            if (!filter_var($result['tapeId'], FILTER_VALIDATE_INT)) {
                throw new \HttpResponseException('Tape ' . $episode['imdbNumber'] . ' could not be registered');
            }
            $episodes[] = [
                'title' => $episode['title'],
                'imdbNumber' => $episode['imdbNumber'],
                'premiere' => $episode['date'],
                'episodeNumber' => $episode['episodeNumber'],
                'tapeId' => $result['tapeId']
            ];
        }

        return $episodes;
    }

    public static function resolve(ContainerInterface $container, array $args): array
    {
        $episodes = [];
        /** @var array $imdbEpisodeList */
        $imdbEpisodeList = EpisodeListResolver::resolve($container, $args);
        if ($imdbEpisodeList) {
            $episodes = self::importEpisodes($container, $imdbEpisodeList);
        }
        return [
            'episodes' => $episodes
        ];
    }
}