<?php

namespace App\Type;

use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PageType extends ObjectType implements CustomType
{
    public function __construct(Types $types, string $className)
    {
        parent::__construct([
            'fields' => [
                'elements' => Type::listOf($types->getOutput($className)),
                'total' => Type::int(),
                'pages' => Type::int()
            ]
        ]);
    }
}
