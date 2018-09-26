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
use App\GraphQL\TypeRegistry;

class SearchResultType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {
        parent::__construct([
            'fields' => [
                'rowTypeId' => Type::int(),
                'rowType' => Type::string(),
                'results' => Type::listOf($typeRegistry->get('searchObject'))
            ]
        ]);
    }
}