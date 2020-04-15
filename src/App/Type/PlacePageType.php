<?php

namespace App\Type;

use App\Entity\Place;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PlacePageType extends ObjectType implements CustomType
{
    public function __construct(Types $types)
    {
        parent::__construct([
            'fields' => [
                'elements' => Type::listOf($types->getOutput(Place::class)),
                'total' => Type::int(),
                'pages' => Type::int()
            ]
        ]);
    }
}
