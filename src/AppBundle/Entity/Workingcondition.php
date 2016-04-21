<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workingcondition
 *
 * @ORM\Table(name="workingcondition")
 * @ORM\Entity
 */
class Workingcondition
{
    /**
     * @var string
     *
     * @ORM\Column(name="workingCondition", type="string", length=255, nullable=false)
     */
    private $workingcondition;

    /**
     * @var integer
     *
     * @ORM\Column(name="multiplier", type="integer", nullable=false)
     */
    private $multiplier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefault", type="boolean", nullable=true)
     */
    private $isdefault;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set workingcondition
     *
     * @param string $workingcondition
     *
     * @return Workingcondition
     */
    public function setWorkingcondition($workingcondition)
    {
        $this->workingcondition = $workingcondition;

        return $this;
    }

    /**
     * Get workingcondition
     *
     * @return string
     */
    public function getWorkingcondition()
    {
        return $this->workingcondition;
    }

    /**
     * Set multiplier
     *
     * @param integer $multiplier
     *
     * @return Workingcondition
     */
    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;

        return $this;
    }

    /**
     * Get multiplier
     *
     * @return integer
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }

    /**
     * Set isdefault
     *
     * @param boolean $isdefault
     *
     * @return Workingcondition
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    /**
     * Get isdefault
     *
     * @return boolean
     */
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Workingcondition
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Workingcondition
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
