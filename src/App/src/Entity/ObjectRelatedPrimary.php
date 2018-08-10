<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/08/2018
 * Time: 17:32
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ObjectRelatedPrimary
{
    use ObjectRelated;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;
}