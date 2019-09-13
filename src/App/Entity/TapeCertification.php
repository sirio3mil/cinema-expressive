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

    use TapeRelated, CountryRelated, CreationDate;

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
    protected $tapeCertificationId;

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
    protected $certification;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="certifications", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;


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
