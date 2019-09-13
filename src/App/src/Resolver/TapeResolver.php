<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 11:44
 */

namespace App\Resolver;

use App\Entity\Tape;
use GraphQL\Doctrine\Definition\EntityID;
use GraphQL\Error\Error;

class TapeResolver implements QueryResolverInterface
{

    /**
     * @param EntityID $tapeId
     * @return Tape
     * @throws Error
     */
    protected function execute(EntityID $tapeId): Tape
    {
        return $tapeId->getEntity();
    }

    /**
     * @inheritDoc
     * @return Tape
     * @throws Error
     */
    public function resolve(array $args): Tape
    {
        return $this->execute($args['tapeId']);
    }
}
