<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/08/2018
 * Time: 12:05
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Object
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Object")
 */
class Object implements CinemaEntity
{

    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="uuid",
     *     name="objectId",
     *     nullable=false,
     *     unique=true,
     *     options={"fixed":false, "default":"newid()"}
     * )
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $objectId;

    /**
     * @var RowType
     *
     * @ORM\ManyToOne(targetEntity="RowType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="rowTypeId", referencedColumnName="rowTypeId")
     */
    private $rowType;


    /**
     * @return UuidInterface
     */
    public function getObjectId(): UuidInterface
    {
        return $this->objectId;
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