<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 18:10
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AlternativeTitleType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'country' => Type::string(),
                'title' => Type::string(),
                'description' => Type::string()
            ]
        ]);
    }
}