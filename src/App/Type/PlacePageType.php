<?php

namespace App\Type;

use App\Entity\Place;
use GraphQL\Doctrine\Types;

class PlacePageType extends PageType
{
    public function __construct(Types $types)
    {
        parent::__construct($types, Place::class);
    }
}
