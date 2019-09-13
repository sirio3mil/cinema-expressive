<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SearchValue
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="SearchValue")
 */
class SearchValue implements CinemaEntity
{

    use ObjectRelated;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="searchValueId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $searchValueId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=250,
     *     name="searchParam",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $searchParam;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=250,
     *     name="slug",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $slug;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\ManyToOne(targetEntity="GlobalUniqueObject", inversedBy="searchValues", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="primaryParam",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    protected $primaryParam = false;


    /**
     * @return int
     */
    public function getSearchValueId(): int
    {
        return $this->searchValueId;
    }

    /**
     * @param string $searchParam
     * @return SearchValue
     */
    public function setSearchParam(string $searchParam): SearchValue
    {
        $this->searchParam = $searchParam;

        return $this;
    }

    /**
     * @return string
     */
    public function getSearchParam(): string
    {
        return $this->searchParam;
    }

    /**
     * @param bool $primaryParam
     * @return SearchValue
     */
    public function setPrimaryParam(bool $primaryParam): SearchValue
    {
        $this->primaryParam = $primaryParam;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrimaryParam(): bool
    {
        return $this->primaryParam;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return SearchValue
     */
    public function setSlug(string $slug): SearchValue
    {
        $this->slug = $slug;

        return $this;
    }
}
