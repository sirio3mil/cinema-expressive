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

    use CreationDate, UniqueObjectGenerated;

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
