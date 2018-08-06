<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class TapeUser
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUser")
 */
class TapeUser implements CinemaEntity
{

    use CreationDate;
    
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeUserId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeUserId;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;


    /**
     * @return int
     */
    public function getTapeUserId(): int
    {
        return $this->tapeUserId;
    }

    /**
     * @param Tape $tape
     * @return TapeUser
     */
    public function setTape(Tape $tape): TapeUser
    {
        $this->tape = $tape;
    
        return $this;
    }

    /**
     * @return Tape
     */
    public function getTape(): Tape
    {
        return $this->tape;
    }

    /**
     * @param User $user
     * @return TapeUser
     */
    public function setUser(User $user): TapeUser
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
