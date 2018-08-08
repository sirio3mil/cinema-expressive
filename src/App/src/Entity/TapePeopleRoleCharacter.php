<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapePeopleRoleCharacter
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapePeopleRoleCharacter")
 * @ORM\HasLifecycleCallbacks
 */
class TapePeopleRoleCharacter implements CinemaEntity
{

    use CreationDate;

    /**
     * @var TapePeopleRole
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="TapePeopleRole", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tapePeopleRoleId", referencedColumnName="tapePeopleRoleId")
     */
    private $tapePeopleRole;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=300,
     *     name="character",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $character;

    /**
     * @param string $character
     * @return TapePeopleRoleCharacter
     */
    public function setCharacter(string $character): TapePeopleRoleCharacter
    {
        $this->character = $character;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getCharacter(): string
    {
        return $this->character;
    }

    /**
     * @param TapePeopleRole $tapePeopleRole
     * @return TapePeopleRoleCharacter
     */
    public function setTapePeopleRole(TapePeopleRole $tapePeopleRole): TapePeopleRoleCharacter
    {
        $this->tapePeopleRole = $tapePeopleRole;
    
        return $this;
    }

    /**
     * @return TapePeopleRole
     */
    public function getTapePeopleRole(): TapePeopleRole
    {
        return $this->tapePeopleRole;
    }
}
