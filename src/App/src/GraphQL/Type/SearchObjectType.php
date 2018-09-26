<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 26/09/2018
 * Time: 23:19
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\TypeRegistry;

class SearchObjectType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {
        parent::__construct([
            'fields' => [
                'objectId' => Type::int(),
                'rank' => Type::float(),
                'results' => Type::listOf($typeRegistry->get('searchMatch'))
            ]
        ]);
    }
}