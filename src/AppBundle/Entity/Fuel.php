<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fuel
 *
 * @ORM\Table(name="fuel")
 * @ORM\Entity
 */
class Fuel
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Currency", inversedBy="fuelId" )
     * @ORM\JoinColumn(name="currencyId", referencedColumnName="id")
     */
    private $currencyId;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceGallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceLiter;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceGallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceLiter;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPercentageRate;
    
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
     * Set fuelPriceGallon
     *
     * @param string $fuelPriceGallon
     * @return Fuel
     */
    public function setFuelPriceGallon($fuelPriceGallon)
    {
        $this->fuelPriceGallon = $fuelPriceGallon;

        return $this;
    }

    /**
     * Get fuelPriceGallon
     *
     * @return string 
     */
    public function getFuelPriceGallon()
    {
        return $this->fuelPriceGallon;
    }

    /**
     * Set fuelPriceLiter
     *
     * @param string $fuelPriceLiter
     * @return Fuel
     */
    public function setFuelPriceLiter($fuelPriceLiter)
    {
        $this->fuelPriceLiter = $fuelPriceLiter;

        return $this;
    }

    /**
     * Get fuelPriceLiter
     *
     * @return string 
     */
    public function getFuelPriceLiter()
    {
        return $this->fuelPriceLiter;
    }

    /**
     * Set defPriceGallon
     *
     * @param string $defPriceGallon
     * @return Fuel
     */
    public function setDefPriceGallon($defPriceGallon)
    {
        $this->defPriceGallon = $defPriceGallon;

        return $this;
    }

    /**
     * Get defPriceGallon
     *
     * @return string 
     */
    public function getDefPriceGallon()
    {
        return $this->defPriceGallon;
    }

    /**
     * Set defPriceLiter
     *
     * @param string $defPriceLiter
     * @return Fuel
     */
    public function setDefPriceLiter($defPriceLiter)
    {
        $this->defPriceLiter = $defPriceLiter;

        return $this;
    }

    /**
     * Get defPriceLiter
     *
     * @return string 
     */
    public function getDefPriceLiter()
    {
        return $this->defPriceLiter;
    }

    /**
     * Set defPercentageRate
     *
     * @param string $defPercentageRate
     * @return Fuel
     */
    public function setDefPercentageRate($defPercentageRate)
    {
        $this->defPercentageRate = $defPercentageRate;

        return $this;
    }

    /**
     * Get defPercentageRate
     *
     * @return string 
     */
    public function getDefPercentageRate()
    {
        return $this->defPercentageRate;
    }

    /**
     * Set currencyId
     *
     * @param \AppBundle\Entity\Currency $currencyId
     * @return Fuel
     */
    public function setCurrencyId(\AppBundle\Entity\Currency $currencyId = null)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * Get currencyId
     *
     * @return \AppBundle\Entity\Currency 
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }
}
