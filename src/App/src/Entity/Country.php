<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Annotation as ORM;


/**
 * Class Country
 * @package App\Entity
 * @ORM\Entity
 */
class Country
{
    /**
     * @var int
     */
    private $countryId;

    /**
     * @var string
     */
    private $officialName;

    /**
     * @var string|null
     */
    private $isoCode;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var Language
     */
    private $language;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Tape", mappedBy="countries", fetch="EXTRA_LAZY")
     */
    private $tapes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tapes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param string $officialName
     * @return Country
     */
    public function setOfficialName(string $officialName): Country
    {
        $this->officialName = $officialName;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getOfficialName(): string
    {
        return $this->officialName;
    }

    /**
     * @param null|string $isoCode
     * @return Country
     */
    public function setIsoCode(?string $isoCode = null): Country
    {
        $this->isoCode = $isoCode;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }

    /**
     * @param \DateTime $createdAt
     * @return Country
     */
    public function setCreatedAt(\DateTime $createdAt): Country
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param Language|null $language
     * @return Country
     */
    public function setLanguage(Language $language = null): Country
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Tape $tape
     * @return Country
     */
    public function addTape(Tape $tape): Country
    {
        $this->tapes[] = $tape;
    
        return $this;
    }

    /**
     * @param Tape $tape
     * @return bool
     */
    public function removeTape(Tape $tape): bool
    {
        return $this->tapes->removeElement($tape);
    }

    /**
     * @return Collection
     */
    public function getTapes(): Collection
    {
        return $this->tapes;
    }
}
