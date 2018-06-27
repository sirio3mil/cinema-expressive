<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:19
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'id' => Type::int(),
                'name' => Type::string()
            ]
        ]);
    }
}