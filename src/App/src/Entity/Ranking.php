<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 06/08/2018
 * Time: 20:35
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Ranking
{
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
        $this->score = $this->convertImdbScore($score);

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
     * @param float $score
     * @return float
     */
    protected function convertImdbScore(float $score): float
    {
        return $this->getVotes() * $score / 2;
    }
}