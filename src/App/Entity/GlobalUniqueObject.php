<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 10/08/2018
 * Time: 12:05
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\LazyCriteriaCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use GraphQL\Doctrine\Annotation as API;

/**
 * Class Object
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Object")
 */
class GlobalUniqueObject implements CinemaEntity
{

    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="uuid",
     *     name="objectId",
     *     nullable=false,
     *     unique=true,
     *     options={"fixed":false, "default":"newid()"}
     * )
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $objectId;

    /**
     * @var RowType
     *
     * @ORM\ManyToOne(targetEntity="RowType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="rowTypeId", referencedColumnName="rowTypeId")
     */
    private $rowType;

    /**
     * @var ImdbNumber
     *
     * @ORM\OneToOne(targetEntity="ImdbNumber", mappedBy="object", cascade={"all"})
     */
    protected $imdbNumber;

    /**
     * @var PermanentLink
     *
     * @ORM\OneToOne(targetEntity="PermanentLink", mappedBy="object")
     */
    protected $permanentLink;

    /**
     * @var Ranking
     *
     * @ORM\OneToOne(targetEntity="Ranking", mappedBy="object", cascade={"all"})
     */
    protected $ranking;

    /**
     * @var People
     *
     * @ORM\OneToOne(targetEntity="People", mappedBy="object")
     */
    protected $people;

    /**
     * @var Tape
     *
     * @ORM\OneToOne(targetEntity="Tape", mappedBy="object", cascade={"all"})
     */
    protected $tape;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="object", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $files;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="SearchValue", mappedBy="object", fetch="EXTRA_LAZY", cascade={"all"})
     */
    protected $searchValues;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->searchValues = new ArrayCollection();
    }


    /**
     * @return UuidInterface
     */
    public function getObjectId(): UuidInterface
    {
        return $this->objectId;
    }

    /**
     * @param RowType $rowType
     * @return GlobalUniqueObject
     */
    public function setRowType(RowType $rowType): GlobalUniqueObject
    {
        $this->rowType = $rowType;

        return $this;
    }

    /**
     * @return RowType
     */
    public function getRowType(): RowType
    {
        return $this->rowType;
    }

    /**
     * @param ImdbNumber $imdbNumber
     * @return GlobalUniqueObject
     */
    public function setImdbNumber(ImdbNumber $imdbNumber): GlobalUniqueObject
    {
        $this->imdbNumber = $imdbNumber->setObject($this);
        return $this;
    }

    /**
     * @return ImdbNumber|null
     */
    public function getImdbNumber(): ?ImdbNumber
    {
        return $this->imdbNumber;
    }

    /**
     * @param PermanentLink $permanentLink
     * @return GlobalUniqueObject
     */
    public function setPermanentLink(PermanentLink $permanentLink): GlobalUniqueObject
    {
        $this->permanentLink = $permanentLink->setObject($this);
        return $this;
    }

    /**
     * @return PermanentLink
     */
    public function getPermanentLink(): PermanentLink
    {
        return $this->permanentLink;
    }

    /**
     * @param Ranking $ranking
     * @return GlobalUniqueObject
     */
    public function setRanking(Ranking $ranking): GlobalUniqueObject
    {
        $this->ranking = $ranking->setObject($this);
        return $this;
    }

    /**
     * @return Ranking|null
     */
    public function getRanking(): ?Ranking
    {
        return $this->ranking;
    }

    /**
     * @param People $people
     * @return GlobalUniqueObject
     */
    public function setPeople(People $people): GlobalUniqueObject
    {
        $this->people = $people->setObject($this);
        return $this;
    }

    /**
     * @return People|null
     */
    public function getPeople(): ?People
    {
        return $this->people;
    }

    /**
     * @param Tape $tape
     * @return GlobalUniqueObject
     */
    public function setTape(Tape $tape): GlobalUniqueObject
    {
        $this->tape = $tape->setObject($this);
        return $this;
    }

    /**
     * @return Tape|null
     */
    public function getTape(): ?Tape
    {
        return $this->tape;
    }

    /**
     * @API\Field(type="?File[]")
     *
     * @return Collection
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    /**
     * @param Collection $files
     * @return GlobalUniqueObject
     */
    public function setFiles(Collection $files): GlobalUniqueObject
    {
        $this->files = $files;
        /** @var File $item */
        foreach ($files as $item) {
            $item->setObject($this);
        }
        return $this;
    }

    /**
     * @param File $file
     * @return GlobalUniqueObject
     */
    public function addFile(File $file): GlobalUniqueObject
    {
        $this->files[] = $file->setObject($this);
        return $this;
    }

    /**
     * @param File $file
     * @return bool
     */
    public function removeFile(File $file): bool
    {
        return $this->files->removeElement($file);
    }

    /**
     * @API\Field(type="?SearchValue[]")
     *
     * @return Collection
     */
    public function getSearchValues(): Collection
    {
        return $this->searchValues;
    }

    /**
     * @param Collection $searchValues
     * @return GlobalUniqueObject
     */
    public function setSearchValues(Collection $searchValues): GlobalUniqueObject
    {
        $this->searchValues = $searchValues;
        /** @var SearchValue $item */
        foreach ($searchValues as $item) {
            $item->setObject($this);
        }
        return $this;
    }

    /**
     * @param SearchValue $searchValue
     * @return GlobalUniqueObject
     */
    public function addSearchValue(SearchValue $searchValue): GlobalUniqueObject
    {
        if (!$this->searchValues->contains($searchValue)) {
            $this->searchValues[] = $searchValue;
            $searchValue->setObject($this);
        }
        return $this;
    }

    /**
     * @param SearchValue $searchValue
     * @return bool
     */
    public function removeSearchValue(SearchValue $searchValue): bool
    {
        return $this->searchValues->removeElement($searchValue);
    }

    /**
     * @param string $slug
     * @return SearchValue|null
     */
    public function getSearchValue(string $slug): ?SearchValue
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("slug", $slug))
            ->setFirstResult(0)
            ->setMaxResults(1);
        /** @var LazyCriteriaCollection $elements */
        $elements = $this->getSearchValues()->matching($criteria);
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }
}
