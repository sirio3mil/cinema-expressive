<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PeopleAlias
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PeopleAlias")
 */
class PeopleAlias
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="peopleAliasId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $peopleAliasId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="alias",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $alias;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="peopleId", referencedColumnName="peopleId")
     */
    private $people;


    /**
     * @return int
     */
    public function getPeopleAliasId(): int
    {
        return $this->peopleAliasId;
    }

    /**
     * @param string $alias
     * @return PeopleAlias
     */
    public function setAlias(string $alias): PeopleAlias
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param People $people
     * @return PeopleAlias
     */
    public function setPeople(People $people): PeopleAlias
    {
        $this->people = $people;
    
        return $this;
    }

    /**
     * @return People
     */
    public function getPeople(): People
    {
        return $this->people;
    }
}
