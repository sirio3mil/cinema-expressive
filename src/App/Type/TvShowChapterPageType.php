<?php

namespace App\Type;

use App\Entity\TvShowChapter;
use GraphQL\Doctrine\Types;

class TvShowChapterPageType extends PageType
{
    /**
     * TvShowChapterPageType constructor.
     * @param Types $types
     */
    public function __construct(Types $types)
    {
        parent::__construct($types, TvShowChapter::class);
    }
}
