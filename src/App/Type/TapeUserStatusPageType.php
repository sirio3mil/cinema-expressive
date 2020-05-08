<?php

namespace App\Type;

use App\Entity\TapeUserStatus;
use GraphQL\Doctrine\Types;

class TapeUserStatusPageType extends PageType
{
    public function __construct(Types $types)
    {
        parent::__construct($types, TapeUserStatus::class);
    }
}
