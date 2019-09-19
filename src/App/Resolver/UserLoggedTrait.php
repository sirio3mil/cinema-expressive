<?php


namespace App\Resolver;

use Zend\Expressive\Authentication\UserInterface;

trait UserLoggedTrait
{
    /** @var UserInterface */
    protected $user;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }
}