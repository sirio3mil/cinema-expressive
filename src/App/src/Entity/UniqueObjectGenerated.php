<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/08/2018
 * Time: 17:29
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

trait UniqueObjectGenerated
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
     *     options={"fixed":false, "default":"newid()"}
     * )
     */
    protected $objectId;

    /** @ORM\PrePersist */
    public function generateObjectId()
    {
        if(is_null($this->objectId)) {
            $this->objectId = Uuid::uuid4();
        }
    }
}