<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;

/**
 * Class Tape
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tape")
 */
class Tape
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="originalTitle",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $originalTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="createdAt",
     *     nullable=false,
     *     options={"default":"sysutcdatetime()"}
     * )
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="guid",
     *     name="objectId",
     *     nullable=false,
     *     options={"fixed":false, "default":"newid()"}
     * )
     */
    private $objectId;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Country", inversedBy="tapes", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="TapeCountry",
     *      joinColumns={@ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="countryId", referencedColumnName="countryId")}
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
    public function getTapeId()
    {
        return $this->tapeId;
    }

    /**
     * Set originaltitle.
     *
     * @param string $originalTitle
     *
     * @return Tape
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    
        return $this;
    }

    /**
     * Get originaltitle.
     *
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdAt
     *
     * @return Tape
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set objectid.
     *
     * @param string $objectId
     *
     * @return Tape
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    
        return $this;
    }

    /**
     * Get objectid.
     *
     * @return string
     */
    public function getObjectId()
    {
        return $this->objectId;
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
