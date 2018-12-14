<?php

namespace App\Entity;

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

    use CreationDate;
    
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
     * @var TapeUser
     *
     * @ORM\ManyToOne(targetEntity="TapeUser", inversedBy="history", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserId", referencedColumnName="tapeUserId")
     */
    private $tapeUser;

    /**
     * @var TapeUserStatus
     *
     * @ORM\ManyToOne(targetEntity="TapeUserStatus", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserStatusId", referencedColumnName="tapeUserStatusId")
     */
    private $tapeUserStatus;

    /**
     * @var TapeUserHistoryDetail
     *
     * @ORM\OneToOne(targetEntity="TapeUserHistoryDetail", mappedBy="tapeUserHistory")
     */
    protected $detail;


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
     * @return TapeUserStatus
     */
    public function getTapeUserStatus(): ?TapeUserStatus
    {
        return $this->tapeUserStatus;
    }

    /**
     * @param TapeUserHistoryDetail $detail
     * @return TapeUserHistory
     */
    public function setDetail(TapeUserHistoryDetail $detail): TapeUserHistory
    {
        $this->detail = $detail->setTapeUserHistory($this);
        return $this;
    }

    /**
     * @return TapeUserHistoryDetail
     */
    public function getDetail(): ?TapeUserHistoryDetail
    {
        return $this->detail;
    }
}
