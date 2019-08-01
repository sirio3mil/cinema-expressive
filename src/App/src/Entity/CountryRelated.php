<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 08/08/2018
 * Time: 22:18
 */

namespace App\Entity;


trait CountryRelated
{
    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="countryId", referencedColumnName="countryId")
     */
    protected $country;

    /**
     * @param Country|null $country
     * @return CountryRelated
     */
    public function setCountry(?Country $country): CountryRelated
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }
}