<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 13:10
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class KeywordType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'keyword' => Type::string(),
                'imdbNumber' => Type::int(),
                'url' => Type::string(),
                'totalVotes' => Type::int(),
                'relevantVotes' => Type::int()
            ]
        ]);
    }
}