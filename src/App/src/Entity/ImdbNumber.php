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

    use UniqueObject;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="guid",
     *     name="objectId",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $objectId;

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
     * @var RowType
     *
     * @ORM\ManyToOne(targetEntity="RowType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="rowTypeId", referencedColumnName="rowTypeId")
     */
    private $rowType;

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

    /**
     * @param RowType $rowType
     * @return ImdbNumber
     */
    public function setRowType(RowType $rowType): ImdbNumber
    {
        $this->rowType = $rowType;
    
        return $this;
    }

    /**
     * @return RowType
     */
    public function getRowType(): RowType
    {
        return $this->rowType;
    }
}
