<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="Location")
 */
class LocationDetail implements CinemaEntity
{

    use CountryRelated;

    /**
     * @var Location
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Location", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="locationId", referencedColumnName="locationId")
     */
    private $location;

    /**
     * @var float
     *
     * @ORM\Column(
     *     type="float",
     *     name="longitude"
     * )
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(
     *     type="float",
     *     name="latitude"
     * )
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=50,
     *     name="area",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=160,
     *     name="subArea",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $subArea;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=80,
     *     name="locality",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=80,
     *     name="street",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=12,
     *     name="street",
     *     nullable=true,
     *     options={"fixed":false}
     * )
     */
    private $postalCode;

    /**
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     name="geolocated",
     *     nullable=false,
     *     options={"default":0}
     * )
     */
    private $geolocated = false;


    /**
     * @param Location $location
     * @return LocationDetail
     */
    public function setLocation(Location $location): LocationDetail
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param float|null $longitude
     * @return LocationDetail
     */
    public function setLongitude(?float $longitude): LocationDetail
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $latitude
     * @return LocationDetail
     */
    public function setLatitude(?float $latitude): LocationDetail
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param null|string $area
     * @return LocationDetail
     */
    public function setArea(?string $area): LocationDetail
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param null|string $subArea
     * @return LocationDetail
     */
    public function setSubArea(?string $subArea): LocationDetail
    {
        $this->subArea = $subArea;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSubArea(): ?string
    {
        return $this->subArea;
    }

    /**
     * @param null|string $locality
     * @return LocationDetail
     */
    public function setLocality(?string $locality): LocationDetail
    {
        $this->locality = $locality;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @param null|string $street
     * @return LocationDetail
     */
    public function setStreet(?string $street): LocationDetail
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param null|string $postalCode
     * @return LocationDetail
     */
    public function setPostalCode(?string $postalCode): LocationDetail
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param bool $geolocated
     * @return LocationDetail
     */
    public function setGeolocated(bool $geolocated): LocationDetail
    {
        $this->geolocated = $geolocated;
    
        return $this;
    }

    /**
     * @return bool
     */
    public function getGeolocated(): bool
    {
        return $this->geolocated;
    }
}
