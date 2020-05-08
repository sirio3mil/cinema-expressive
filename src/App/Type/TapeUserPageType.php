<?php

namespace App\Type;

use App\Entity\TapeUser;
use GraphQL\Doctrine\Types;

class TapeUserPageType extends PageType
{
    public function __construct(Types $types)
    {
        parent::__construct($types, TapeUser::class);
    }
}
