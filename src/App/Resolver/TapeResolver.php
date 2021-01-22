<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 11:44
 */

namespace App\Resolver;

use App\Entity\Tape;

class TapeResolver extends AbstractResolver implements QueryResolverInterface
{
    /**
     * @inheritDoc
     * @return Tape
     */
    public function resolve(array $args): Tape
    {
        return $args['tapeId']->getEntity();
    }
}
