<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
