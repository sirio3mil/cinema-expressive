<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class TapePeopleRole
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapePeopleRole")
 */
class TapePeopleRole implements CinemaEntity
{

    use CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapePeopleRoleId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapePeopleRoleId;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="peopleId", referencedColumnName="peopleId")
     */
    private $people;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="roleId", referencedColumnName="roleId")
     */
    private $role;


    /**
     * @return int
     */
    public function getTapePeopleRoleId(): int
    {
        return $this->tapePeopleRoleId;
    }

    /**
     * @param Tape $tape
     * @return TapePeopleRole
     */
    public function setTape(Tape $tape): TapePeopleRole
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

    /**
     * @param People $people
     * @return TapePeopleRole
     */
    public function setPeople(People $people): TapePeopleRole
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

    /**
     * @param Role $role
     * @return TapePeopleRole
     */
    public function setRole(Role $role): TapePeopleRole
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }
}
