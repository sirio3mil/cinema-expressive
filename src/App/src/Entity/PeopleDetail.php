<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PeopleDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PeopleDetail")
 * @ORM\HasLifecycleCallbacks
 */
class PeopleDetail implements CinemaEntity
{

    use CreationDate, Upgradeable, CountryRelated;

    /**
     * @var People
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="People", inversedBy="detail", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="peopleId", referencedColumnName="peopleId")
     */
    private $people;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=1,
     *     name="gender",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $gender;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="havePhoto",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $havePhoto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="date",
     *     name="birthDate",
     *     nullable=true
     * )
     */
    private $birthDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="date",
     *     name="deathDate",
     *     nullable=true
     * )
     */
    private $deathDate;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=250,
     *     name="birthPlace",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $birthPlace;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=250,
     *     name="deathPlace",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $deathPlace;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="smallint",
     *     name="height",
     *     nullable=true,
     *     options={"unsigned":false}
     * )
     */
    private $height;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="skip",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $skip = false;


    /**
     * @param null|string $gender
     * @return PeopleDetail
     */
    public function setGender(?string $gender): PeopleDetail
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param bool $havePhoto
     * @return PeopleDetail
     */
    public function setHavePhoto(bool $havePhoto): PeopleDetail
    {
        $this->havePhoto = $havePhoto;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getHavePhoto(): bool
    {
        return $this->havePhoto;
    }

    /**
     * @param \DateTime|null $birthDate
     * @return PeopleDetail
     */
    public function setBirthDate(?\DateTime $birthDate): PeopleDetail
    {
        $this->birthDate = $birthDate;
    
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime|null $deathDate
     * @return PeopleDetail
     */
    public function setDeathDate(?\DateTime $deathDate): PeopleDetail
    {
        $this->deathDate = $deathDate;
    
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeathDate(): ?\DateTime
    {
        return $this->deathDate;
    }

    /**
     * @param null|string $birthPlace
     * @return PeopleDetail
     */
    public function setBirthPlace(?string $birthPlace): PeopleDetail
    {
        $this->birthPlace = $birthPlace;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    /**
     * @param null|string $deathPlace
     * @return PeopleDetail
     */
    public function setDeathPlace(?string $deathPlace): PeopleDetail
    {
        $this->deathPlace = $deathPlace;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDeathPlace(): ?string
    {
        return $this->deathPlace;
    }

    /**
     * @param int|null $height
     * @return PeopleDetail
     */
    public function setHeight(?int $height): PeopleDetail
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param bool $skip
     * @return PeopleDetail
     */
    public function setSkip(bool $skip): PeopleDetail
    {
        $this->skip = $skip;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getSkip(): bool
    {
        return $this->skip;
    }

    /**
     * @param People $people
     * @return PeopleDetail
     */
    public function setPeople(People $people): PeopleDetail
    {
        $this->people = $people;
    
        return $this;
    }

    /**
     * @return People
     */
    public function getPeople(): People
    {
        return $this->people;
    }
}
