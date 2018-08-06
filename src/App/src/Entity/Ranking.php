<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 06/08/2018
 * Time: 20:35
 */

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

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
     *     type="int",
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
        return $this->votes;
    }

    /**
     * @param int $score
     * @return CinemaEntity
     */
    public function setScore(int $score): CinemaEntity
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}