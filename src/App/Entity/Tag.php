<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Tag
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tag")
 * @ORM\HasLifecycleCallbacks
 */
class Tag implements CinemaEntity
{

    use TapeCollection, CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tagId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="keyword",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $keyword;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="tags", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $tapes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tapes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tagId;
    }

    /**
     * @param string $keyword
     * @return Tag
     */
    public function setKeyword(string $keyword): Tag
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }
}
