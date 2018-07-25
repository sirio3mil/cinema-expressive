<?php

namespace App\Entity;

/**
 * Tapeuserhistorydetail
 */
class Tapeuserhistorydetail
{
    /**
     * @var int
     */
    private $tapeuserhistoryid;

    /**
     * @var bool
     */
    private $visible = '0';

    /**
     * @var bool
     */
    private $exported = '0';

    /**
     * @var int|null
     */
    private $place;

    /**
     * @var \DateTime
     */
    private $createdat = 'sysutcdatetime()';

    /**
     * @var \DateTime
     */
    private $updatedat = 'sysutcdatetime()';


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
     * Set visible.
     *
     * @param bool $visible
     *
     * @return Tapeuserhistorydetail
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    
        return $this;
    }

    /**
     * Get visible.
     *
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set exported.
     *
     * @param bool $exported
     *
     * @return Tapeuserhistorydetail
     */
    public function setExported($exported)
    {
        $this->exported = $exported;
    
        return $this;
    }

    /**
     * Get exported.
     *
     * @return bool
     */
    public function getExported()
    {
        return $this->exported;
    }

    /**
     * Set place.
     *
     * @param int|null $place
     *
     * @return Tapeuserhistorydetail
     */
    public function setPlace($place = null)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place.
     *
     * @return int|null
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime $createdat
     *
     * @return Tapeuserhistorydetail
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
     * Set updatedat.
     *
     * @param \DateTime $updatedat
     *
     * @return Tapeuserhistorydetail
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
    
        return $this;
    }

    /**
     * Get updatedat.
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }
}
