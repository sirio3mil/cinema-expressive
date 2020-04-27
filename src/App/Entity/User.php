<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     *     length=40,
     *     name="username",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $username;

    /**
     * @var string|null
     */
    private $token;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="WishList", mappedBy="user", fetch="EXTRA_LAZY")
     */
    protected $wishList;

    public function __construct()
    {
        $this->wishList = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string|null $token
     * @return User
     */
    public function setToken(?string $token): User
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return Collection
     */
    public function getWishList(): Collection
    {
        return $this->wishList;
    }
}
