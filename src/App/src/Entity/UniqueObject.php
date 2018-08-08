<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/07/2018
 * Time: 11:48
 */

namespace App\Entity;


use Ramsey\Uuid\UuidInterface;

trait UniqueObject
{
    /**
     * @param UuidInterface $objectId
     * @return CinemaEntity
     */
    public function setObjectId(UuidInterface $objectId): CinemaEntity
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return UuidInterface
     */
    public function getObjectId(): UuidInterface
    {
        return $this->objectId;
    }
}