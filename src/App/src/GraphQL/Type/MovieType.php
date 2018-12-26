<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 14:51
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MovieType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'year' => Type::int(),
                'title' => Type::string(),
                'duration' => Type::int(),
                'color' => Type::string(),
                'isTvShow' => Type::boolean(),
                'imdbNumber' => Type::int()
            ]
        ]);
    }
}