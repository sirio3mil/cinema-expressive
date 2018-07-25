<?php

namespace App\Entity;

/**
 * Genre
 */
class Genre
{
    /**
     * @var int
     */
    private $genreid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tapeid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tapeid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get genreid.
     *
     * @return int
     */
    public function getGenreid()
    {
        return $this->genreid;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Genre
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
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Genre
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
     * Add tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return Genre
     */
    public function addTapeid(\App\Entity\Tape $tapeid)
    {
        $this->tapeid[] = $tapeid;
    
        return $this;
    }

    /**
     * Remove tapeid.
     *
     * @param \App\Entity\Tape $tapeid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTapeid(\App\Entity\Tape $tapeid)
    {
        return $this->tapeid->removeElement($tapeid);
    }

    /**
     * Get tapeid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTapeid()
    {
        return $this->tapeid;
    }
}
