<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 06/08/2018
 * Time: 20:39
 */

namespace App\Entity;


trait Upgradeable
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="updatedAt",
     *     nullable=false,
     *     options={"default":"sysutcdatetime()"}
     * )
     */
    protected $updatedAt;

    /**
     * @param \DateTime $updatedAt
     * @return CinemaEntity
     */
    public function setUpdatedAt(\DateTime $updatedAt): CinemaEntity
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}