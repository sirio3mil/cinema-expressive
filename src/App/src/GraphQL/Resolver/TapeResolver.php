<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 11:44
 */

namespace App\GraphQL\Resolver;

use App\Entity\Tape;

class TapeResolver
{

    /**
     * @param array $args
     * @return Tape
     */
    public static function resolve(array $args): Tape
    {
        return $args['tapeId']->getEntity();
    }
}