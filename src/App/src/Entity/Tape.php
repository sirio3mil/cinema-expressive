<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;

/**
 * Class Tape
 * @package App\Entity
 * @ORM\Entity
 */
class Tape
{
    /**
     * @var int
     */
    private $tapeid;

    /**
     * @var string
     */
    private $originaltitle;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var string
     */
    private $objectid = 'newid()';

    /**
     * @var Collection
     * @ManyToMany(targetEntity="Country", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @JoinTable(name="TapeCountry",
     *      joinColumns={@JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@JoinColumn(name="countryId", referencedColumnName="countryId")}
     *     )
     */
    private $countries;

    /**
     * @var Collection
     */
    private $genreid;

    /**
     * @var Collection
     */
    private $languageid;

    /**
     * @var Collection
     */
    private $locationid;

    /**
     * @var Collection
     */
    private $producerid;

    /**
     * @var Collection
     */
    private $tagid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countries = new ArrayCollection();
        $this->genreid = new ArrayCollection();
        $this->languageid = new ArrayCollection();
        $this->locationid = new ArrayCollection();
        $this->producerid = new ArrayCollection();
        $this->tagid = new ArrayCollection();
    }

    /**
     * Get tapeid.
     *
     * @return int
     */
    public function getTapeid()
    {
        return $this->tapeid;
    }

    /**
     * Set originaltitle.
     *
     * @param string $originaltitle
     *
     * @return Tape
     */
    public function setOriginaltitle($originaltitle)
    {
        $this->originaltitle = $originaltitle;
    
        return $this;
    }

    /**
     * Get originaltitle.
     *
     * @return string
     */
    public function getOriginaltitle()
    {
        return $this->originaltitle;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tape
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
     * Set objectid.
     *
     * @param string $objectid
     *
     * @return Tape
     */
    public function setObjectid($objectid)
    {
        $this->objectid = $objectid;
    
        return $this;
    }

    /**
     * Get objectid.
     *
     * @return string
     */
    public function getObjectid()
    {
        return $this->objectid;
    }

    /**
     * @param Country $country
     * @return Tape
     */
    public function addCountry(Country $country): Tape
    {
        $this->countries[] = $country;
    
        return $this;
    }

    /**
     * @param Country $country
     * @return bool
     */
    public function removeCountry(Country $country): bool
    {
        return $this->countries->removeElement($country);
    }

    /**
     * @return Collection
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    /**
     * Add genreid.
     *
     * @param \App\Entity\Genre $genreid
     *
     * @return Tape
     */
    public function addGenreid(\App\Entity\Genre $genreid)
    {
        $this->genreid[] = $genreid;
    
        return $this;
    }

    /**
     * Remove genreid.
     *
     * @param \App\Entity\Genre $genreid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGenreid(\App\Entity\Genre $genreid)
    {
        return $this->genreid->removeElement($genreid);
    }

    /**
     * Get genreid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenreid()
    {
        return $this->genreid;
    }

    /**
     * Add languageid.
     *
     * @param \App\Entity\Language $languageid
     *
     * @return Tape
     */
    public function addLanguageid(\App\Entity\Language $languageid)
    {
        $this->languageid[] = $languageid;
    
        return $this;
    }

    /**
     * Remove languageid.
     *
     * @param \App\Entity\Language $languageid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLanguageid(\App\Entity\Language $languageid)
    {
        return $this->languageid->removeElement($languageid);
    }

    /**
     * Get languageid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguageid()
    {
        return $this->languageid;
    }

    /**
     * Add locationid.
     *
     * @param \App\Entity\Location $locationid
     *
     * @return Tape
     */
    public function addLocationid(\App\Entity\Location $locationid)
    {
        $this->locationid[] = $locationid;
    
        return $this;
    }

    /**
     * Remove locationid.
     *
     * @param \App\Entity\Location $locationid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLocationid(\App\Entity\Location $locationid)
    {
        return $this->locationid->removeElement($locationid);
    }

    /**
     * Get locationid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocationid()
    {
        return $this->locationid;
    }

    /**
     * Add producerid.
     *
     * @param \App\Entity\Producer $producerid
     *
     * @return Tape
     */
    public function addProducerid(\App\Entity\Producer $producerid)
    {
        $this->producerid[] = $producerid;
    
        return $this;
    }

    /**
     * Remove producerid.
     *
     * @param \App\Entity\Producer $producerid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProducerid(\App\Entity\Producer $producerid)
    {
        return $this->producerid->removeElement($producerid);
    }

    /**
     * Get producerid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducerid()
    {
        return $this->producerid;
    }

    /**
     * Add tagid.
     *
     * @param \App\Entity\Tag $tagid
     *
     * @return Tape
     */
    public function addTagid(\App\Entity\Tag $tagid)
    {
        $this->tagid[] = $tagid;
    
        return $this;
    }

    /**
     * Remove tagid.
     *
     * @param \App\Entity\Tag $tagid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTagid(\App\Entity\Tag $tagid)
    {
        return $this->tagid->removeElement($tagid);
    }

    /**
     * Get tagid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTagid()
    {
        return $this->tagid;
    }
}
