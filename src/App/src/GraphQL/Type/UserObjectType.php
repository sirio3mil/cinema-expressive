<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 12/12/2018
 * Time: 16:07
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserObjectType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {
        parent::__construct([
            'fields' => [
                'score' => Type::float(),
                'scoreDate' => Type::string(),
                'objectUserId' => Type::int(),
                'history' => Type::listOf($typeRegistry->get('userHistory'))
            ]
        ]);
    }
}