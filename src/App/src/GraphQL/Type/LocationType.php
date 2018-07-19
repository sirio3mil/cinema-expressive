<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 17:10
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class LocationType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'location' => Type::string(),
                'totalVotes' => Type::int(),
                'relevantVotes' => Type::int()
            ]
        ]);
    }
}