<?php

namespace App\Entity;

/**
 * Tapepeoplerolecharacter
 */
class Tapepeoplerolecharacter
{
    /**
     * @var string
     */
    private $character;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Tapepeoplerole
     */
    private $tapepeopleroleid;


    /**
     * Set character.
     *
     * @param string $character
     *
     * @return Tapepeoplerolecharacter
     */
    public function setCharacter($character)
    {
        $this->character = $character;
    
        return $this;
    }

    /**
     * Get character.
     *
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tapepeoplerolecharacter
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
     * Set tapepeopleroleid.
     *
     * @param \App\Entity\Tapepeoplerole $tapepeopleroleid
     *
     * @return Tapepeoplerolecharacter
     */
    public function setTapepeopleroleid(\App\Entity\Tapepeoplerole $tapepeopleroleid)
    {
        $this->tapepeopleroleid = $tapepeopleroleid;
    
        return $this;
    }

    /**
     * Get tapepeopleroleid.
     *
     * @return \App\Entity\Tapepeoplerole
     */
    public function getTapepeopleroleid()
    {
        return $this->tapepeopleroleid;
    }
}
