<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUserStatus
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUserStatus")
 * @ORM\Cache("READ_ONLY")
 */
class TapeUserStatus implements CinemaEntity
{

    public const WISH_LIST = 3;
    public const VIEW = 2;
    public const DOWNLOADED = 1;

    /**
     * @ORM\Id
     * @ORM\Column(
     *     type="smallint",
     *     name="tapeUserStatusId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $tapeUserStatusId;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="description",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private string $description;


    /**
     * @return int
     */
    public function getTapeUserStatusId(): int
    {
        return $this->tapeUserStatusId;
    }

    /**
     * @param string $description
     * @return TapeUserStatus
     */
    public function setDescription(string $description): TapeUserStatus
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
