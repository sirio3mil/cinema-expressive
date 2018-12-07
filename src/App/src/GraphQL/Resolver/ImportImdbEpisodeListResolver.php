<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\Wrapper\EpisodeListWrapper;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\Adapter\Memcache;

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
        /** @var AbstractAdapter $cacheStorageAdapter */
        $cacheStorageAdapter = $container->get(Memcache::class);
        /** @var array $imdbEpisodeList */
        $imdbEpisodeList = CachedQueryResolver::resolve($cacheStorageAdapter, new EpisodeListWrapper(), $args);
        if ($imdbEpisodeList) {
            $episodes = self::importEpisodes($container, $imdbEpisodeList);
        }
        return [
            'episodes' => $episodes
        ];
    }
}