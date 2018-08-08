<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeUser
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeUser")
 * @ORM\HasLifecycleCallbacks
 */
class TapeUser implements CinemaEntity
{

    use CreationDate, TapeRelatedColumn;
    
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
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
