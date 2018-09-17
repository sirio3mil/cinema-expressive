<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/09/2018
 * Time: 23:27
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class ChaptersFromViewedTvShow
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="ChaptersFromViewedTvShow")
 */
class ChaptersFromViewedTvShow implements CinemaEntity
{
    /**
     * @var TvShow
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="TvShow", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tvShowId", referencedColumnName="tapeId")
     */
    private $tvShow;

    /**
     * @var TvShowChapter
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="TvShowChapter", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="chapterId", referencedColumnName="tapeId")
     */
    private $chapter;

    /**
     * @var User
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;

    /**
     * @return TvShow
     */
    public function getTvShow(): TvShow
    {
        return $this->tvShow;
    }

    /**
     * @return TvShowChapter
     */
    public function getChapter(): TvShowChapter
    {
        return $this->chapter;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}