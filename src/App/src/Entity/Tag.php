<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;
use ImdbScraper\Model\Keyword;


/**
 * Class Tag
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tag")
 */
class Tag implements CinemaEntity
{

    use TapeCollection;

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
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="tags", fetch="EXTRA_LAZY")
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
     * @return Keyword
     */
    public function setKeyword(string $keyword): Keyword
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
