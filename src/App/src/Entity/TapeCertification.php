<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeCertification
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeCertification")
 * @ORM\HasLifecycleCallbacks
 */
class TapeCertification implements CinemaEntity
{

    use TapeRelatedColumn, CountryRelated, CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeCertificationId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeCertificationId;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     type="string",
     *     length=20,
     *     name="certification",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $certification;


    /**
     * @return int
     */
    public function getTapeCertificationId(): int
    {
        return $this->tapeCertificationId;
    }

    /**
     * @param null|string $certification
     * @return TapeCertification
     */
    public function setCertification(?string $certification): TapeCertification
    {
        $this->certification = $certification;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCertification(): ?string
    {
        return $this->certification;
    }
}
