<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class PeopleAliasTape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PeopleAliasTape")
 */
class PeopleAliasTape implements CinemaEntity
{

    use CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="peopleAliasTapeId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $peopleAliasTapeId;

    /**
     * @var PeopleAlias
     *
     * @ORM\ManyToOne(targetEntity="PeopleAlias", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="peopleAliasId", referencedColumnName="peopleAliasId")
     */
    private $peopleAlias;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;


    /**
     * @return int
     */
    public function getPeopleAliasTapeId(): int
    {
        return $this->peopleAliasTapeId;
    }

    /**
     * @param PeopleAlias $peopleAlias
     * @return PeopleAliasTape
     */
    public function setPeopleAlias(PeopleAlias $peopleAlias): PeopleAliasTape
    {
        $this->peopleAlias = $peopleAlias;
    
        return $this;
    }

    /**
     * @return PeopleAlias
     */
    public function getPeopleAlias(): PeopleAlias
    {
        return $this->peopleAlias;
    }

    /**
     * @param Tape $tape
     * @return PeopleAliasTape
     */
    public function setTape(Tape $tape):PeopleAliasTape
    {
        $this->tape = $tape;
    
        return $this;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }
}
