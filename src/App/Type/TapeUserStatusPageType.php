<?php

namespace App\Type;

use App\Entity\TapeUserStatus;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class TapeUserStatusPageType extends ObjectType implements CustomType
{
    public function __construct(Types $types)
    {
        parent::__construct([
            'fields' => [
                'elements' => Type::listOf($types->getOutput(TapeUserStatus::class)),
                'total' => Type::int(),
                'pages' => Type::int()
            ]
        ]);
    }
}
