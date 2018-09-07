<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\TypeRegistry;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use Interop\Container\ContainerInterface;
use MongoDB\Collection;
use App\Alias\MongoDBClient;

class ImportImdbEpisodeListResolver
{

    protected static function importEpisodes(TypeRegistry $typeRegistry, array $episodeList)
    {
        $episodes = [];

        foreach ($episodeList as $episode){
            $result = ImportImdbMovieResolver::resolve($typeRegistry, $episode);
            if(!filter_var($result['tapeId'], FILTER_VALIDATE_INT)){
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

    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {
        $source = CachedDocumentNodeResolver::resolve($typeRegistry->getCacheStorageAdapter(),
            'queries/graphql/EpisodeList.graphql');
        /** @var ExecutionResult $gqQueryResult */
        $gqQueryResult = GraphQL::executeQuery(
            $typeRegistry->getSchema(),
            $source,
            null,
            null,
            [
                "imdbNumber" => $args['imdbNumber'],
                "seasonNumber" => $args['seasonNumber']
            ]
        );
        $date = new \DateTime();
        /** @var ContainerInterface $container */
        $container = $typeRegistry->getContainer();
        $searchValues = [
            "imdbNumber" => $args['imdbNumber'],
            "seasonNumber" => $args['seasonNumber']
        ];
        /** @var Collection $collection */
        $container->get(MongoDBClient::class)
            ->cinema
            ->episodes
            ->findOneAndReplace(
                $searchValues,
                array_merge($gqQueryResult->data, $searchValues, ["updated" => $date]),
                [
                    "upsert" => true
                ]
            );
        $episodes = [];
        if(!empty($gqQueryResult->data['imdbEpisodeList']) && is_array($gqQueryResult->data['imdbEpisodeList'])){
            $episodes = self::importEpisodes($typeRegistry, $gqQueryResult->data['imdbEpisodeList']);
        }
        return [
            'episodes' => $episodes,
            'tvShowId' => 0
        ];
    }
}