<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUserHistoryDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUserHistoryDetail")
 * @ORM\HasLifecycleCallbacks
 */
class TapeUserHistoryDetail implements CinemaEntity
{

    use CreationDate, Upgradeable;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeUserHistoryId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeUserHistoryId;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="visible",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $visible;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="exported",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $exported;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="place",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $place;


    /**
     * @return int
     */
    public function getTapeUserHistoryId(): int
    {
        return $this->tapeUserHistoryId;
    }

    /**
     * @param bool $visible
     * @return TapeUserHistoryDetail
     */
    public function setVisible(bool $visible): TapeUserHistoryDetail
    {
        $this->visible = $visible;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $exported
     * @return TapeUserHistoryDetail
     */
    public function setExported(bool $exported): TapeUserHistoryDetail
    {
        $this->exported = $exported;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getExported(): bool
    {
        return $this->exported;
    }

    /**
     * @param int|null $place
     * @return TapeUserHistoryDetail
     */
    public function setPlace(?int $place): TapeUserHistoryDetail
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPlace(): ?int
    {
        return $this->place;
    }
}
