<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/09/2018
 * Time: 23:33
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TvShowChapterSummary
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="usr.TvShowChapterSummary")
 */
class TvShowChapterSummary implements CinemaEntity
{
    /**
     * @var TvShow
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="TvShow", fetch="EXTRA_LAZY", inversedBy="summaries")
     * @ORM\JoinColumn(name="tvShowId", referencedColumnName="tapeId")
     */
    private $tvShow;

    /**
     * @var User
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;

    /**
     * @var TvShowChapter|null
     *
     * @ORM\OneToOne(targetEntity="TvShowChapter", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="importedChapterId", referencedColumnName="tapeId")
     */
    private $importedChapter;

    /**
     * @var TvShowChapter|null
     *
     * @ORM\OneToOne(targetEntity="TvShowChapter", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="viewedChapterId", referencedColumnName="tapeId")
     */
    private $viewedChapter;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return TvShow
     */
    public function getTvShow(): TvShow
    {
        return $this->tvShow;
    }

    /**
     * @return TvShowChapter|null
     */
    public function getImportedChapter(): ?TvShowChapter
    {
        return $this->importedChapter;
    }

    /**
     * @return TvShowChapter|null
     */
    public function getViewedChapter(): ?TvShowChapter
    {
        return $this->viewedChapter;
    }
}
