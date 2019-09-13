<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PermanentLink
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PermanentLink")
 */
class PermanentLink implements CinemaEntity
{

    use ObjectRelated;

    /**
     * @var GlobalUniqueObject
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="GlobalUniqueObject", inversedBy="permanentLink", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="objectId", referencedColumnName="objectId")
     */
    protected $object;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=150,
     *     name="url",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $url;

    /**
     * @param string $url
     * @return PermanentLink
     */
    public function setUrl(string $url): PermanentLink
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
