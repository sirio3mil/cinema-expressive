<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Role
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Role")
 */
class Role implements CinemaEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="smallint",
     *     name="roleId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="role",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $role;

    /**
     * @param int $roleId
     * @return Role
     */
    public function setRoleId(int $roleId): Role
    {
        $this->roleId = $roleId;

        return $this;
    }


    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param string $role
     * @return Role
     */
    public function setRole(string $role): Role
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
}
