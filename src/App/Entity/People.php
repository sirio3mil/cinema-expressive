<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use GraphQL\Doctrine\Annotation as API;

/**
 * Class People
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="People")
 * @ORM\HasLifecycleCallbacks
 */
class People implements CinemaEntity
{

    use CreationDate, ObjectRelated;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="peopleId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $peopleId;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", inversedBy="people")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=100,
     *     name="fullName",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $fullName;

    /**
     * @var PeopleDetail
     *
     * @ORM\OneToOne(targetEntity="PeopleDetail", mappedBy="people")
     */
    protected $detail;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAlias", mappedBy="people", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $aliases;

    public function __construct()
    {
        $this->aliases = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * @param string $fullName
     * @return People
     */
    public function setFullName(string $fullName): People
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param PeopleDetail $detail
     * @return People
     */
    public function setDetail(PeopleDetail $detail): People
    {
        $this->detail = $detail->setPeople($this);
        return $this;
    }

    /**
     * @return PeopleDetail|null
     */
    public function getDetail(): ?PeopleDetail
    {
        return $this->detail;
    }

    /**
     * @param Collection $aliases
     * @return People
     */
    public function setAliases(Collection $aliases): People
    {
        $this->aliases = $aliases;
        /** @var PeopleAlias $item */
        foreach ($aliases as $item) {
            $item->setPeople($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?PeopleAlias[]")
     *
     * @return Collection
     */
    public function getAliases(): Collection
    {
        return $this->aliases;
    }

    /**
     * @param PeopleAlias $peopleAlias
     * @return People
     */
    public function addAlias(PeopleAlias $peopleAlias): People
    {
        $this->aliases[] = $peopleAlias->setPeople($this);
        return $this;
    }

    /**
     * @param PeopleAlias $peopleAlias
     * @return bool
     */
    public function removePeople(PeopleAlias $peopleAlias): bool
    {
        return $this->aliases->removeElement($peopleAlias);
    }
}
