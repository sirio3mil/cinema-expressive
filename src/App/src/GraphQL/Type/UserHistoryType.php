<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 12/12/2018
 * Time: 16:04
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserHistoryType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {
        parent::__construct([
            'fields' => [
                'status' => Type::string(),
                'statusId' => Type::int(),
                'date' => Type::string(),
                'details' => $typeRegistry->get('userHistoryDetail')
            ]
        ]);
    }
}