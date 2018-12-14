<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 12/12/2018
 * Time: 16:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUserScore
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUserScore")
 * @ORM\HasLifecycleCallbacks
 */
class TapeUserScore implements CinemaEntity
{

    use CreationDate;

    /**
     * @var TapeUser
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="TapeUser", inversedBy="score", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapeUserId", referencedColumnName="tapeUserId")
     */
    private $tapeUser;

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
     *     type="float",
     *     name="score",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    protected $score;

    /**
     * @param TapeUser $tapeUser
     * @return TapeUserScore
     */
    public function setTapeUser(TapeUser $tapeUser): TapeUserScore
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
     * @param float $score
     * @return TapeUserScore
     */
    public function setScore(float $score): TapeUserScore
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score ?? 0;
    }

    /**
     * @param bool $exported
     * @return TapeUserScore
     */
    public function setExported(bool $exported): TapeUserScore
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

    /** @ORM\PrePersist */
    public function generateExportedFlag()
    {
        if(is_null($this->exported)) {
            $this->setExported(false);
        }
    }

}