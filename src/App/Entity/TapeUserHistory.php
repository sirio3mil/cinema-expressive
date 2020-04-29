<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUserHistory
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUserHistory")
 * @ORM\HasLifecycleCallbacks
 */
class TapeUserHistory implements CinemaEntity
{

    use CreationDate, Upgradeable, SoftDeleteable;

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
    private int $tapeUserHistoryId;

    /**
     * @var TapeUser
     *
     * @ORM\ManyToOne(targetEntity="TapeUser", inversedBy="history", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserId", referencedColumnName="tapeUserId")
     */
    private TapeUser $tapeUser;

    /**
     * @var TapeUserStatus
     *
     * @ORM\ManyToOne(targetEntity="TapeUserStatus", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserStatusId", referencedColumnName="tapeUserStatusId")
     */
    private TapeUserStatus $tapeUserStatus;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TapeUserHistoryDetail", mappedBy="tapeUserHistory", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected Collection $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->tapeUser = new TapeUser();
        $this->tapeUserStatus = new TapeUserStatus();
        $this->tapeUserHistoryId = 0;
    }

    /**
     * @return int
     */
    public function getTapeUserHistoryId(): int
    {
        return $this->tapeUserHistoryId;
    }

    /**
     * @param TapeUser $tapeUser
     * @return TapeUserHistory
     */
    public function setTapeUser(TapeUser $tapeUser): TapeUserHistory
    {
        $this->tapeUser = $tapeUser;

        return $this;
    }

    /**
     * @return TapeUser
     */
    public function getTapeUser(): TapeUser
    {
        return $this->tapeUser;
    }

    /**
     * @param TapeUserStatus $tapeUserStatus
     * @return TapeUserHistory
     */
    public function setTapeUserStatus(TapeUserStatus $tapeUserStatus): TapeUserHistory
    {
        $this->tapeUserStatus = $tapeUserStatus;

        return $this;
    }

    /**
     * @return TapeUserStatus|null
     */
    public function getTapeUserStatus(): ?TapeUserStatus
    {
        return $this->tapeUserStatus;
    }

    /**
     * @param Collection $details
     * @return TapeUserHistory
     */
    public function setDetails(Collection $details): TapeUserHistory
    {
        $this->details = $details;
        /** @var TapeUserHistoryDetail $item */
        foreach ($details as $item) {
            $item->setTapeUserHistory($this);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    /**
     * @param TapeUserHistoryDetail $detail
     * @return TapeUserHistory
     */
    public function addDetail(TapeUserHistoryDetail $detail): TapeUserHistory
    {
        $this->details[] = $detail->setTapeUserHistory($this);
        return $this;
    }

    /**
     * @param TapeUserHistoryDetail $detail
     * @return bool
     */
    public function removeDetail(TapeUserHistoryDetail $detail): bool
    {
        return $this->details->removeElement($detail);
    }
}
