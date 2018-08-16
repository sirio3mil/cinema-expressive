<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/07/2018
 * Time: 11:46
 */

namespace App\Entity;


use Doctrine\Common\Collections\Collection;

trait TapeCollection
{
    /**
     * @param Tape $tape
     * @return CinemaEntity
     */
    public function addTape(Tape $tape): CinemaEntity
    {
        $this->tapes[] = $tape;

        return $this;
    }

    /**
     * @param Tape $tape
     * @return bool
     */
    public function removeTape(Tape $tape): bool
    {
        return $this->tapes->removeElement($tape);
    }

    /**
     * @return Collection
     */
    public function getTapes(): Collection
    {
        return $this->tapes;
    }
}