<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * Class SearchValue
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="SearchValue")
 */
class SearchValue implements CinemaEntity
{

    use UniqueObject;

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
     * @var UuidInterface
     *
     * @ORM\Column(
     *     type="uuid",
     *     name="objectId",
     *     nullable=false,
     *     unique=true,
     *     options={"fixed":false}
     * )
     */
    private $objectId;

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
