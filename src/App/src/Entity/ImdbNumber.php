<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use function str_pad;

/**
 * Class ImdbNumber
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="ImdbNumber")
 */
class ImdbNumber implements CinemaEntity
{

    use ObjectRelated;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", inversedBy="imdbNumber", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

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

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        $formattedNumber = str_pad($this->imdbNumber, 7, "0", STR_PAD_LEFT);
        $rowType = $this->object->getRowType();

        switch ($rowType->getRowTypeId()) {
            case RowType::ROW_TYPE_TAPE:
                return "https://www.imdb.com/title/tt{$formattedNumber}/";
            case RowType::ROW_TYPE_PEOPLE:
                return "https://www.imdb.com/name/nm{$formattedNumber}/";
        }

        return null;
    }
}
