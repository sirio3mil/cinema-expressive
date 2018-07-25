<?php

namespace App\Entity;

/**
 * Locationdetail
 */
class Locationdetail
{
    /**
     * @var int
     */
    private $locationid;

    /**
     * @var float|null
     */
    private $longitude;

    /**
     * @var float|null
     */
    private $latitude;

    /**
     * @var string|null
     */
    private $area;

    /**
     * @var string|null
     */
    private $subarea;

    /**
     * @var string|null
     */
    private $locality;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $postalcode;

    /**
     * @var bool
     */
    private $geolocated = '0';

    /**
     * @var \App\Entity\Country
     */
    private $countryid;


    /**
     * Get locationid.
     *
     * @return int
     */
    public function getLocationid()
    {
        return $this->locationid;
    }

    /**
     * Set longitude.
     *
     * @param float|null $longitude
     *
     * @return Locationdetail
     */
    public function setLongitude($longitude = null)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude.
     *
     * @return float|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude.
     *
     * @param float|null $latitude
     *
     * @return Locationdetail
     */
    public function setLatitude($latitude = null)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude.
     *
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set area.
     *
     * @param string|null $area
     *
     * @return Locationdetail
     */
    public function setArea($area = null)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area.
     *
     * @return string|null
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set subarea.
     *
     * @param string|null $subarea
     *
     * @return Locationdetail
     */
    public function setSubarea($subarea = null)
    {
        $this->subarea = $subarea;
    
        return $this;
    }

    /**
     * Get subarea.
     *
     * @return string|null
     */
    public function getSubarea()
    {
        return $this->subarea;
    }

    /**
     * Set locality.
     *
     * @param string|null $locality
     *
     * @return Locationdetail
     */
    public function setLocality($locality = null)
    {
        $this->locality = $locality;
    
        return $this;
    }

    /**
     * Get locality.
     *
     * @return string|null
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set street.
     *
     * @param string|null $street
     *
     * @return Locationdetail
     */
    public function setStreet($street = null)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street.
     *
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postalcode.
     *
     * @param string|null $postalcode
     *
     * @return Locationdetail
     */
    public function setPostalcode($postalcode = null)
    {
        $this->postalcode = $postalcode;
    
        return $this;
    }

    /**
     * Get postalcode.
     *
     * @return string|null
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set geolocated.
     *
     * @param bool $geolocated
     *
     * @return Locationdetail
     */
    public function setGeolocated($geolocated)
    {
        $this->geolocated = $geolocated;
    
        return $this;
    }

    /**
     * Get geolocated.
     *
     * @return bool
     */
    public function getGeolocated()
    {
        return $this->geolocated;
    }

    /**
     * Set countryid.
     *
     * @param \App\Entity\Country|null $countryid
     *
     * @return Locationdetail
     */
    public function setCountryid(\App\Entity\Country $countryid = null)
    {
        $this->countryid = $countryid;
    
        return $this;
    }

    /**
     * Get countryid.
     *
     * @return \App\Entity\Country|null
     */
    public function getCountryid()
    {
        return $this->countryid;
    }
}
