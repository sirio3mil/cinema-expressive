<?php

namespace App\Entity;

use Doctrine\ORM\Annotation as ORM;

/**
 * Class TapeTitle
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeTitle")
 */
class TapeTitle implements CinemaEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="tapeTitleId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tapeTitleId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="title",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="observations",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $observations;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    private $tape;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    private $countryId;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language", fetch="EXTRA_LAZY", orphanRemoval=false)
     * @ORM\JoinColumn(name="languageId", referencedColumnName="languageId")
     */
    private $languageId;


    /**
     * @return int
     */
    public function getTapeTitleId(): int
    {
        return $this->tapeTitleId;
    }

    /**
     * @param string $title
     * @return TapeTitle
     */
    public function setTitle(string $title): TapeTitle
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param null|string $observations
     * @return TapeTitle
     */
    public function setObservations(?string $observations): TapeTitle
    {
        $this->observations = $observations;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * @param Tape $tape
     * @return TapeTitle
     */
    public function setTape(Tape $tape): TapeTitle
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
     * @param Country|null $countryId
     * @return TapeTitle
     */
    public function setCountryId(?Country $countryId): TapeTitle
    {
        $this->countryId = $countryId;
    
        return $this;
    }

    /**
     * @return Country|null
     */
    public function getCountryId(): ?Country
    {
        return $this->countryId;
    }

    /**
     * @param Language|null $languageId
     * @return TapeTitle
     */
    public function setLanguageId(?Language $languageId): TapeTitle
    {
        $this->languageId = $languageId;
    
        return $this;
    }

    /**
     * @return Language|null
     */
    public function getLanguageId(): ?Language
    {
        return $this->languageId;
    }
}
