<?php

namespace App\Entity;

/**
 * User
 */
class User
{
    /**
     * @var int
     */
    private $userid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string|null
     */
    private $remembertoken;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \DateTime|null
     */
    private $updatedat;


    /**
     * Get userid.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
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
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set remembertoken.
     *
     * @param string|null $remembertoken
     *
     * @return User
     */
    public function setRemembertoken($remembertoken = null)
    {
        $this->remembertoken = $remembertoken;
    
        return $this;
    }

    /**
     * Get remembertoken.
     *
     * @return string|null
     */
    public function getRemembertoken()
    {
        return $this->remembertoken;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return User
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

    /**
     * Set updatedat.
     *
     * @param \DateTime|null $updatedat
     *
     * @return User
     */
    public function setUpdatedat($updatedat = null)
    {
        $this->updatedat = $updatedat;
    
        return $this;
    }

    /**
     * Get updatedat.
     *
     * @return \DateTime|null
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }
}
