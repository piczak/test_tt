<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Fuel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity
 */
class Currency
{
    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255, nullable=false)
     */
    private $currency;

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
    private $isDefault;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Fuel", mappedBy="currencyId", cascade={"persist","remove"})
     */
    private $fuelId;

    /**
     * Set currency
     *
     * @param string $currency
     * @return Currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Currency
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
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Currency
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
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

    /**
     * Set fuelId
     *
     * @param \AppBundle\Entity\Fuel $fuelId
     * @return Currency
     */
    public function setFuelId(\AppBundle\Entity\Fuel $fuelId = null)
    {
        $this->fuelId = $fuelId;
        $fuelId->setCurrencyId($this);

        return $this;
    }

    /**
     * Get fuelId
     *
     * @return \AppBundle\Entity\Fuel 
     */
    public function getFuelId()
    {
        return $this->fuelId;
    }
}
