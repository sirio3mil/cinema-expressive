<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PeopleAliasTape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PeopleAliasTape")
 * @ORM\HasLifecycleCallbacks
 */
class PeopleAliasTape implements CinemaEntity
{

    use CreationDate, TapeRelated;

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
     * @ORM\ManyToOne(targetEntity="PeopleAlias", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="peopleAliasId", referencedColumnName="peopleAliasId")
     */
    private $peopleAlias;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="aliases", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

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
}
