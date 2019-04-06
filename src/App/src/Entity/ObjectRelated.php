<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/07/2018
 * Time: 11:48
 */

namespace App\Entity;

trait ObjectRelated
{

    /**
     * @param GlobalUniqueObject $object
     * @return CinemaEntity
     */
    public function setObject(GlobalUniqueObject $object): CinemaEntity
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return GlobalUniqueObject
     */
    public function getObject(): GlobalUniqueObject
    {
        return $this->object;
    }
}