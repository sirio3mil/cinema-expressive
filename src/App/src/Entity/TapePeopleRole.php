<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapePeopleRole
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapePeopleRole")
 * @ORM\HasLifecycleCallbacks
 */
class TapePeopleRole implements CinemaEntity
{

    use CreationDate, TapeRelated;

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
    protected $tapePeopleRoleId;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="people", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

    /**
     * @var People
     *
     * @ORM\ManyToOne(targetEntity="People", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="peopleId", referencedColumnName="peopleId")
     */
    protected $people;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="roleId", referencedColumnName="roleId")
     */
    protected $role;

    /**
     * @var TapePeopleRoleCharacter
     *
     * @ORM\OneToOne(
     *     targetEntity="TapePeopleRoleCharacter",
     *     mappedBy="tapePeopleRole",
     *     fetch="EXTRA_LAZY",
     *     cascade={"all"}
     * )
     */
    private $character;


    /**
     * @return int
     */
    public function getTapePeopleRoleId(): int
    {
        return $this->tapePeopleRoleId;
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

    /**
     * @param TapePeopleRoleCharacter $character
     * @return TapePeopleRole
     */
    public function setCharacter(TapePeopleRoleCharacter $character): TapePeopleRole
    {
        $this->character = $character->setTapePeopleRole($this);
        return $this;
    }

    /**
     * @return TapePeopleRoleCharacter|null
     */
    public function getCharacter(): ?TapePeopleRoleCharacter
    {
        return $this->character;
    }
}
