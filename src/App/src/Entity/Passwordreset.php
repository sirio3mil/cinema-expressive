<?php

namespace App\Entity;

/**
 * Passwordreset
 */
class Passwordreset
{
    /**
     * @var int
     */
    private $passwordresetid;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTime
     */
    private $createdat;


    /**
     * Get passwordresetid.
     *
     * @return int
     */
    public function getPasswordresetid()
    {
        return $this->passwordresetid;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Passwordreset
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return Passwordreset
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Passwordreset
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    
        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }
}
