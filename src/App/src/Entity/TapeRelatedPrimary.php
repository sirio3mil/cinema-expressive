<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 08/08/2018
 * Time: 22:07
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TapeRelatedPrimary
{

    use TapeRelated;

    /**
     * @var Tape
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Tape", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;
}