<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 26/09/2018
 * Time: 23:17
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class SearchResultType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'searchParam' => Type::string(),
                'objectId' => Type::string(),
                'rowTypeId' => Type::int(),
                'rowType' => Type::string(),
                'internalId' => Type::int(),
                'imdbNumber' => Type::int(),
                'original' => Type::string(),
                'year' => Type::int()
            ]
        ]);
    }
}