<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 12/12/2018
 * Time: 16:01
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserHistoryDetailType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'date' => Type::string(),
                'placeId' => Type::int(),
                'visible' => Type::boolean(),
                'exported' => Type::boolean(),
                'place' => Type::string()
            ]
        ]);
    }
}