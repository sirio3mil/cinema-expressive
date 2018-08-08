<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 08/08/2018
 * Time: 22:10
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TapeRelatedColumn
{

    use TapeRelated;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

}