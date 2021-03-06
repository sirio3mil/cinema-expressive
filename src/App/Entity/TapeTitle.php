<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TapeTitle
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="TapeTitle")
 */
class TapeTitle implements CinemaEntity
{

    use TapeRelated, CountryRelated;

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
    protected $tapeTitleId;

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
    protected $title;

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
    protected $observations;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="languageId")
     */
    protected $language;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="titles", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;


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
     * @param Language|null $language
     * @return TapeTitle
     */
    public function setLanguage(?Language $language): TapeTitle
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }
}
