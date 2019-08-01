<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 06/08/2018
 * Time: 20:39
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Exception;

trait Upgradeable
{
    /**
     * @var DateTime
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
     * @param DateTime $updatedAt
     * @return Upgradeable
     */
    public function setUpdatedAt(DateTime $updatedAt): Upgradeable
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @throws Exception
     *
     * @ORM\PrePersist
     */
    public function generateUpgradeDate()
    {
        $this->updatedAt = DateGenerator::getUtcDateTime();
    }

    /**
     * @throws Exception
     *
     * @ORM\PreUpdate
     */
    public function upgradeDate()
    {
        $this->updatedAt = DateGenerator::getUtcDateTime();
    }
}