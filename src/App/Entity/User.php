<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="[User]")
 * @ORM\HasLifecycleCallbacks
 */
class User implements CinemaEntity
{

    use CreationDate, Upgradeable;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="userId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     name="name",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     name="email",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     name="password",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="rememberToken",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $rememberToken;


    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param null|string $rememberToken
     * @return User
     */
    public function setRememberToken(?string $rememberToken): User
    {
        $this->rememberToken = $rememberToken;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }
}
