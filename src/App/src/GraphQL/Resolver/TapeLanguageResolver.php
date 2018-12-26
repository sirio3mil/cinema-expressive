<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 14:43
 */

namespace App\GraphQL\Resolver;

use App\Entity\Tape;

class TapeLanguageResolver
{
    public static function resolve(array $args): array
    {
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();
        if (!$tape) {
            throw new \InvalidArgumentException('Tape not found');
        }
        return $tape->getLanguages()->toArray();
    }
}