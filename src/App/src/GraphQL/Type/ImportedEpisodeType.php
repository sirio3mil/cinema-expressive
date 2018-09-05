<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 18:10
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ImportedEpisodeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'title' => Type::string(),
                'imdbNumber' => Type::int(),
                'premiere' => Type::string(),
                'episodeNumber' => Type::int(),
                'seasonNumber' => Type::int(),
                'tapeId' => Type::int()
            ]
        ]);
    }
}