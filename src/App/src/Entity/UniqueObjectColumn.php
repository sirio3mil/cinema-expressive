<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/08/2018
 * Time: 17:34
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait UniqueObjectColumn
{
    use UniqueObject;

    /**
     * @var UuidInterface
     *
     * @ORM\Column(
     *     type="uuid",
     *     name="objectId",
     *     nullable=false,
     *     unique=true,
     *     options={"fixed":false}
     * )
     */
    private $objectId;
}