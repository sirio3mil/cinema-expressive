<?php

namespace App\Entity;

/**
 * Tapeuserhistory
 */
class Tapeuserhistory
{
    /**
     * @var int
     */
    private $tapeuserhistoryid;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \App\Entity\Tapeuser
     */
    private $tapeuserid;

    /**
     * @var \App\Entity\Tapeuserstatus
     */
    private $tapeuserstatusid;


    /**
     * Get tapeuserhistoryid.
     *
     * @return int
     */
    public function getTapeuserhistoryid()
    {
        return $this->tapeuserhistoryid;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tapeuserhistory
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    
        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set tapeuserid.
     *
     * @param \App\Entity\Tapeuser|null $tapeuserid
     *
     * @return Tapeuserhistory
     */
    public function setTapeuserid(\App\Entity\Tapeuser $tapeuserid = null)
    {
        $this->tapeuserid = $tapeuserid;
    
        return $this;
    }

    /**
     * Get tapeuserid.
     *
     * @return \App\Entity\Tapeuser|null
     */
    public function getTapeuserid()
    {
        return $this->tapeuserid;
    }

    /**
     * Set tapeuserstatusid.
     *
     * @param \App\Entity\Tapeuserstatus|null $tapeuserstatusid
     *
     * @return Tapeuserhistory
     */
    public function setTapeuserstatusid(\App\Entity\Tapeuserstatus $tapeuserstatusid = null)
    {
        $this->tapeuserstatusid = $tapeuserstatusid;
    
        return $this;
    }

    /**
     * Get tapeuserstatusid.
     *
     * @return \App\Entity\Tapeuserstatus|null
     */
    public function getTapeuserstatusid()
    {
        return $this->tapeuserstatusid;
    }
}
