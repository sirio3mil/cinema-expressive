<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ImdbNumber
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="ImdbNumber")
 */
class ImdbNumber implements CinemaEntity
{

    use ObjectRelatedPrimary;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="bigint",
     *     name="imdbNumber",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $imdbNumber;

    /**
     * @param int $imdbNumber
     * @return ImdbNumber
     */
    public function setImdbNumber(int $imdbNumber): ImdbNumber
    {
        $this->imdbNumber = $imdbNumber;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getImdbNumber(): int
    {
        return $this->imdbNumber;
    }
}
