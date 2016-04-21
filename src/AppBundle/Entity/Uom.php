<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uom
 *
 * @ORM\Table(name="uom")
 * @ORM\Entity
 */
class Uom
{
    /**
     * @var string
     *
     * @ORM\Column(name="uom", type="string", length=255, nullable=false)
     */
    private $uom;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255, nullable=false)
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefault", type="boolean", nullable=false)
     */
    private $isdefault;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set uom
     *
     * @param string $uom
     *
     * @return Uom
     */
    public function setUom($uom)
    {
        $this->uom = $uom;

        return $this;
    }

    /**
     * Get uom
     *
     * @return string
     */
    public function getUom()
    {
        return $this->uom;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Uom
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Uom
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set isdefault
     *
     * @param boolean $isdefault
     *
     * @return Uom
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
