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
     * @var Object
     *
     * @ORM\ManyToOne(targetEntity="Object", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;


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
}
