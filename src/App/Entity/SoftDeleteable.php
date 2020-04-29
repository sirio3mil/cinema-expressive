<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait SoftDeleteable
{
    /**
     * @var DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="deletedAt",
     *     nullable=true
     * )
     */
    protected DateTime $deletedAt;

    /**
     * @param DateTime $deletedAt
     * @return $this
     */
    public function setDeletedAt(DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return null !== $this->deletedAt;
    }
}
