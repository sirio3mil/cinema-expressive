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
     * @param Object $object
     * @return CinemaEntity
     */
    public function setObject(Object $object): CinemaEntity
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return Object
     */
    public function getObject(): Object
    {
        return $this->object;
    }
}