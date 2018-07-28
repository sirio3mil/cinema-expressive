<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 28/07/2018
 * Time: 23:48
 */

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

trait CreationDate
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="createdAt",
     *     nullable=false,
     *     options={"default":"sysutcdatetime()"}
     * )
     */
    protected $createdAt;

    /**
     * @param \DateTime $createdAt
     * @return CinemaEntity
     */
    public function setCreatedAt(\DateTime $createdAt): CinemaEntity
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

}
