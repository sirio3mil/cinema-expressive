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
     * @return TapeRelated
     */
    public function setTape(Tape $tape): self
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