<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 26/09/2018
 * Time: 23:29
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class SearchMatchType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'searchValueId' => Type::int(),
                'searchParam' => Type::string()
            ]
        ]);
    }
}