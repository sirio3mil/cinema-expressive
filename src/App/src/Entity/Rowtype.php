<?php

namespace App\Entity;

/**
 * Rowtype
 */
class Rowtype
{
    /**
     * @var int
     */
    private $rowtypeid;

    /**
     * @var string
     */
    private $description;


    /**
     * Get rowtypeid.
     *
     * @return int
     */
    public function getRowtypeid()
    {
        return $this->rowtypeid;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Rowtype
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
