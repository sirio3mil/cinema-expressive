<?php


namespace App\Type;

use App\Entity\TapeUser;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class TapeUserPageType extends ObjectType implements CustomType
{
    public function __construct(Types $types)
    {
        parent::__construct([
            'fields' => [
                'elements' => Type::listOf($types->getOutput(TapeUser::class)),
                'total' => Type::int(),
                'pages' => Type::int()
            ]
        ]);
    }
}
