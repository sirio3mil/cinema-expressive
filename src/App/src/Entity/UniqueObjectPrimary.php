<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/08/2018
 * Time: 17:32
 */

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

trait UniqueObjectPrimary
{
    use UniqueObject;

    /**
     * @var UuidInterface
     *
     * @ORM\Id
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