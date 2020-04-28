<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthUser
 * @package App\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="[Oauth].[dbo].[oauth_users]")
 */
class OauthUser implements CinemaEntity
{
    /**
     * @var User
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User", inversedBy="oauthUser")
     * @ORM\JoinColumn(name="username", referencedColumnName="username")
     */
    protected $user;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     type="string",
     *     length=80,
     *     name="first_name",
     *     nullable=true
     * )
     */
    protected $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     type="string",
     *     length=80,
     *     name="last_name",
     *     nullable=true
     * )
     */
    protected $lastName;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
}
