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
use Ramsey\Uuid\Uuid;
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
    protected UuidInterface $objectId;

    /**
     * @var RowType
     *
     * @ORM\ManyToOne(targetEntity="RowType", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="rowTypeId", referencedColumnName="rowTypeId")
     */
    private RowType $rowType;

    /**
     * @var ImdbNumber|null
     *
     * @ORM\OneToOne(targetEntity="ImdbNumber", mappedBy="object", cascade={"all"})
     */
    protected ?ImdbNumber $imdbNumber;

    /**
     * @var PermanentLink|null
     *
     * @ORM\OneToOne(targetEntity="PermanentLink", mappedBy="object")
     */
    protected ?PermanentLink $permanentLink;

    /**
     * @var Ranking|null
     *
     * @ORM\OneToOne(targetEntity="Ranking", mappedBy="object", cascade={"all"})
     */
    protected ?Ranking $ranking;

    /**
     * @var People|null
     *
     * @ORM\OneToOne(targetEntity="People", mappedBy="object")
     */
    protected ?People $people;

    /**
     * @var Tape|null
     *
     * @ORM\OneToOne(targetEntity="Tape", mappedBy="object", cascade={"all"})
     */
    protected ?Tape $tape;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="object", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
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
        $this->tape = null;
        $this->people = null;
        $this->ranking = null;
        $this->permanentLink = null;
        $this->imdbNumber = null;
        $this->rowType = new RowType();
        $this->objectId = Uuid::uuid4();
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
    public function getPermanentLink(): ?PermanentLink
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
        $criteria = Criteria::create()
            ->where(Criteria::expr()->isNull('deletedAt'));
        return $this->files->matching($criteria);
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function haveFilename(string $filename): bool
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('name', $filename));
        $elements = $this->files->matching($criteria);
        if ($elements->count()) {
            return true;
        }
        return false;
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

    /**
     * @return File|null
     */
    public function getThumbnail(): ?File
    {
        $files = $this->getFiles();
        $elements = $files->filter(function ($element) {
            return $element->getFileType()->getFileTypeId() === FileType::THUMBNAIL;
        });
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }

    /**
     * @return File|null
     */
    public function getCover(): ?File
    {
        $files = $this->getFiles();
        $elements = $files->filter(function ($element) {
            return $element->getFileType()->getFileTypeId() === FileType::ORIGINAL;
        });
        if ($elements->count()) {
            return $elements->first();
        }
        return null;
    }
}
