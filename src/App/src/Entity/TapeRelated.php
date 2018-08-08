<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 08/08/2018
 * Time: 22:12
 */

namespace App\Entity;


trait TapeRelated
{
    /**
     * @param Tape $tape
     * @return CinemaEntity
     */
    public function setTape(Tape $tape): CinemaEntity
    {
        $this->tape = $tape;

        return $this;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }
}