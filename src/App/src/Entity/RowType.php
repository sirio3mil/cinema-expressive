<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RowType
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="RowType")
 */
class RowType
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="tinyint",
     *     name="rowTypeId",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $rowTypeId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="description",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $description;

    /**
     * @param int $rowTypeId
     * @return RowType
     */
    public function setRowTypeId(int $rowTypeId): RowType
    {
        $this->rowTypeId = $rowTypeId;

        return $this;
    }


    /**
     * @return int
     */
    public function getRowTypeId(): int
    {
        return $this->rowTypeId;
    }

    /**
     * @param string $description
     * @return RowType
     */
    public function setDescription(string $description): RowType
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
