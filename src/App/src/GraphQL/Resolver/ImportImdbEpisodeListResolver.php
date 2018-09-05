<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\TypeRegistry;

class ImportImdbEpisodeListResolver
{
    public static function resolve(TypeRegistry $typeRegistry, array $args): array
    {
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