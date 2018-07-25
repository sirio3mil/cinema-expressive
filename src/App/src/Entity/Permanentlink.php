<?php

namespace App\Entity;

/**
 * Permanentlink
 */
class Permanentlink
{
    /**
     * @var string
     */
    private $objectid;

    /**
     * @var string
     */
    private $url;


    /**
     * Get objectid.
     *
     * @return string
     */
    public function getObjectid()
    {
        return $this->objectid;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Permanentlink
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
