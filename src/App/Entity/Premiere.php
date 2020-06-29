<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use GraphQL\Doctrine\Annotation as API;
use DateTime;

/**
 * Class Premiere
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Premiere")
 * @ORM\HasLifecycleCallbacks
 */
class Premiere implements CinemaEntity
{

    use TapeRelated, CountryRelated, CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="premiereId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $premiereId;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *     type="date",
     *     name="date",
     *     nullable=false
     * )
     */
    protected $date;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=10,
     *     name="place",
     *     nullable=false,
     *     options={"fixed":false,"default":"Movie"}
     * )
     */
    protected $place;

    /**
     * @var Tape
     *
     * @ORM\ManyToOne(targetEntity="Tape", inversedBy="premieres", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="tapeId", referencedColumnName="tapeId")
     */
    protected $tape;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PremiereDetail", mappedBy="premiere", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getPremiereId(): int
    {
        return $this->premiereId;
    }

    /**
     * @param DateTime $date
     * @return Premiere
     */
    public function setDate(DateTime $date): Premiere
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param string $place
     * @return Premiere
     */
    public function setPlace(string $place): Premiere
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /** @ORM\PrePersist */
    public function generatePlace()
    {
        if ($this->place === null) {
            $this->place = "Movie";
        }
    }

    /**
     * @param Collection $details
     * @return Premiere
     */
    public function setDetails(Collection $details): Premiere
    {
        $this->details = $details;
        /** @var PremiereDetail $item */
        foreach ($details as $item) {
            $item->setPremiere($this);
        }
        return $this;
    }

    /**
     * @API\Field(type="?PremiereDetail[]")
     *
     * @return Collection
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    /**
     * @param PremiereDetail $detail
     * @return Premiere
     */
    public function addDetail(PremiereDetail $detail): Premiere
    {
        $this->details[] = $detail->setPremiere($this);
        return $this;
    }

    /**
     * @param string $observation
     * @return Premiere
     */
    public function addObservation(string $observation): Premiere
    {
        return $this->addDetail((new PremiereDetail())->setObservation($observation));
    }

    /**
     * @param PremiereDetail $detail
     * @return bool
     */
    public function removeDetail(PremiereDetail $detail): bool
    {
        return $this->details->removeElement($detail);
    }

    /**
     * @param string $observation
     * @return PremiereDetail|null
     */
    public function getDetail(string $observation): ?PremiereDetail
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("observation", $observation))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getDetails()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }
}
