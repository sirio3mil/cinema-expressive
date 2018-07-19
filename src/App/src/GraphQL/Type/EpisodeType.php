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

class EpisodeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'title' => Type::string(),
                'imdbNumber' => Type::int(),
                'date' => Type::string(),
                'episodeNumber' => Type::int(),
                'isFullDate' => Type::boolean()
            ]
        ]);
    }
}