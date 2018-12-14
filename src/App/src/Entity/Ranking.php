<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 06/08/2018
 * Time: 20:35
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ranking
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Ranking")
 */
class Ranking implements CinemaEntity
{

    use ObjectRelated;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", inversedBy="ranking", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="bigint",
     *     name="votes",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    protected $votes;

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
     * @param int $votes
     * @return CinemaEntity
     */
    public function setVotes(int $votes): CinemaEntity
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes ?? 0;
    }

    /**
     * @param float $score
     * @return CinemaEntity
     */
    public function setScore(float $score): CinemaEntity
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
     * @param float $calculatedValue
     * @return CinemaEntity
     */
    public function setScoreFromCalculatedValue(float $calculatedValue): CinemaEntity
    {
        return $this->setScore($this->getVotes() * $calculatedValue / 2);
    }

    /**
     * @return float
     */
    public function getCalculatedScore(): float
    {
        if (!$this->getVotes()) {
            return 0;
        }
        return $this->getScore() / $this->getVotes();
    }
}