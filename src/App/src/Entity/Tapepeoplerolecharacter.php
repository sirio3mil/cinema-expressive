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
     * @var \App\Entity\TapePeopleRole
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
     * @param \App\Entity\TapePeopleRole $tapepeopleroleid
     *
     * @return Tapepeoplerolecharacter
     */
    public function setTapepeopleroleid(\App\Entity\TapePeopleRole $tapepeopleroleid)
    {
        $this->tapepeopleroleid = $tapepeopleroleid;
    
        return $this;
    }

    /**
     * Get tapepeopleroleid.
     *
     * @return \App\Entity\TapePeopleRole
     */
    public function getTapepeopleroleid()
    {
        return $this->tapepeopleroleid;
    }
}
