<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class People
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="People")
 */
class People implements CinemaEntity
{

    use CreationDate, UniqueObject;

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
     * @var string
     *
     * @ORM\Column(
     *     type="guid",
     *     name="objectId",
     *     nullable=false,
     *     options={"fixed":false, "default":"newid()"}
     * )
     */
    protected $objectId;

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
}
