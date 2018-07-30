<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class PeopleDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PeopleDetail")
 */
class PeopleDetail implements CinemaEntity
{
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
     * @var int
     *
     * @ORM\Column(
     *     type="bigint",
     *     name="votes",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    private $votes = 0;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="int",
     *     name="score",
     *     nullable=false,
     *     options={"unsigned":false,"default":0}
     * )
     */
    private $score = 0;

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
     * @var \DateTime
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="updatedAt",
     *     nullable=false,
     *     options={"default":"sysutcdatetime()"}
     * )
     */
    private $updatedAt;

    /**
     * @var People
     *
     * @ORM\OneToOne(targetEntity="People", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="peopleId", referencedColumnName="peopleId")
     */
    private $people;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    private $country;


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
     * @param int $votes
     * @return PeopleDetail
     */
    public function setVotes(int $votes): PeopleDetail
    {
        $this->votes = $votes;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * @param int $score
     * @return PeopleDetail
     */
    public function setScore(int $score): PeopleDetail
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
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
     * @param \DateTime $updatedAt
     * @return PeopleDetail
     */
    public function setUpdatedAt(\DateTime $updatedAt): PeopleDetail
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
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

    /**
     * @param Country|null $country
     * @return PeopleDetail
     */
    public function setCountry(?Country $country): PeopleDetail
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }
}
