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
        return [
            'episodes' => [
                [
                    'title' => '',
                    'imdbNumber' => 0,
                    'premiere' => '',
                    'episodeNumber' => 0,
                    'seasonNumber' => 0,
                    'tapeId' => 0
                ]
            ],
            'tvShowId' => 0
        ];
    }
}