<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 28/07/2018
 * Time: 23:48
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Exception;

trait CreationDate
{

    /**
     * @var DateTime
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
     * @param DateTime $createdAt
     * @return CreationDate
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @throws Exception
     *
     * @ORM\PrePersist
     */
    public function generateCreationDate()
    {
        if(is_null($this->createdAt)) {
            $this->createdAt = DateGenerator::getUtcDateTime();
        }
    }
}
