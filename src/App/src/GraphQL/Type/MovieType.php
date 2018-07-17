<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 14:51
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MovieType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'year' => Type::int(),
                'title' => Type::string(),
                'languages' => Type::listOf(Type::string()),
                'duration' => Type::int(),
                'color' => Type::string(),
                'recommendations' => Type::listOf(Type::int()),
                'countries' => Type::listOf(Type::string()),
                'tvShow' => Type::int(),
                'haveReleaseInfo' => Type::boolean(),
                'isTvShow' => Type::boolean(),
                'isEpisode' => Type::boolean(),
                'genres' => Type::listOf(Type::string()),
                'sounds' => Type::listOf(Type::string()),
                'score' => Type::float(),
                'votes' => Type::int()
            ]
        ]);
    }
}