<?php

namespace App\Entity;

/**
 * Role
 */
class Role
{
    /**
     * @var int
     */
    private $roleid;

    /**
     * @var string
     */
    private $role;


    /**
     * Get roleid.
     *
     * @return int
     */
    public function getRoleid()
    {
        return $this->roleid;
    }

    /**
     * Set role.
     *
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
