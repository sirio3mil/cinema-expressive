<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 17:28
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CastType extends ObjectType
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