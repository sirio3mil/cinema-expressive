<?php

namespace App\Entity;

/**
 * Tapeuserstatus
 */
class Tapeuserstatus
{
    /**
     * @var int
     */
    private $tapeuserstatusid;

    /**
     * @var string
     */
    private $statusdescription;


    /**
     * Get tapeuserstatusid.
     *
     * @return int
     */
    public function getTapeuserstatusid()
    {
        return $this->tapeuserstatusid;
    }

    /**
     * Set statusdescription.
     *
     * @param string $statusdescription
     *
     * @return Tapeuserstatus
     */
    public function setStatusdescription($statusdescription)
    {
        $this->statusdescription = $statusdescription;
    
        return $this;
    }

    /**
     * Get statusdescription.
     *
     * @return string
     */
    public function getStatusdescription()
    {
        return $this->statusdescription;
    }
}
