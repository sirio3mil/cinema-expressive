<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/07/2018
 * Time: 11:48
 */

namespace App\Entity;


trait UniqueObject
{
    /**
     * @var string
     *
     * @ORM\Column(
     *     type="guid",
     *     name="objectId",
     *     nullable=false,
     *     options={"fixed":false, "default":"newid()"}
     * )
     */
    private $objectId;

    /**
     * @param string $objectId
     * @return CinemaEntity
     */
    public function setObjectId(string $objectId): CinemaEntity
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return string
     */
    public function getObjectId(): string
    {
        return $this->objectId;
    }
}