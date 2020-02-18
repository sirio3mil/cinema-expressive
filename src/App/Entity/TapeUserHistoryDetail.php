<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use GraphQL\Doctrine\Annotation as API;

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
     *     name="tapeUserHistoryDetailId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeUserHistoryDetailId;

    /**
     * @var TapeUserHistory
     *
     * @ORM\ManyToOne(targetEntity="TapeUserHistory", inversedBy="details", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserHistoryId", referencedColumnName="tapeUserHistoryId")
     */
    private $tapeUserHistory;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="visible",
     *     nullable=false,
     *     options={"default":1}
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
     * @var Place
     *
     * @ORM\ManyToOne(targetEntity="Place", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="placeId", referencedColumnName="placeId")
     */
    private $place;


    /**
     * @API\Exclude
     *
     * @param TapeUserHistory $tapeUserHistory
     * @return TapeUserHistoryDetail
     */
    public function setTapeUserHistory(TapeUserHistory $tapeUserHistory): TapeUserHistoryDetail
    {
        $this->tapeUserHistory = $tapeUserHistory;
        return $this;
    }

    /**
     * @return TapeUserHistory
     */
    public function getTapeUserHistory(): TapeUserHistory
    {
        return $this->tapeUserHistory;
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
     * @param Place|null $place
     * @return TapeUserHistoryDetail
     */
    public function setPlace(?Place $place): TapeUserHistoryDetail
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Place|null
     */
    public function getPlace(): ?Place
    {
        return $this->place;
    }

    /** @ORM\PrePersist */
    public function generateVisibleFlag()
    {
        if (is_null($this->visible)) {
            $this->setVisible(true);
        }
    }

    /** @ORM\PrePersist */
    public function generateExportedFlag()
    {
        if (is_null($this->exported)) {
            $this->setExported(false);
        }
    }

    /**
     * @param int $tapeUserHistoryDetailId
     * @return TapeUserHistoryDetail
     */
    public function setTapeUserHistoryDetailId(int $tapeUserHistoryDetailId): TapeUserHistoryDetail
    {
        $this->tapeUserHistoryDetailId = $tapeUserHistoryDetailId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTapeUserHistoryDetailId(): int
    {
        return $this->tapeUserHistoryDetailId;
    }
}
