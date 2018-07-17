<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 16:54
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PersonType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'fullName' => Type::string(),
                'imdbNumber' => Type::int(),
                'character' => Type::string(),
                'alias' => Type::string()
            ]
        ]);
    }
}