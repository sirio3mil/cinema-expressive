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

    use UniqueObjectPrimary;

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
