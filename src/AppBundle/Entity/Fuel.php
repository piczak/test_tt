<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fuel", options={"collate":"utf8_unicode_ci", "charset":"utf8", "engine":"InnoDB"})
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
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceUS_Gallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceUS_Liter;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceCAN_Gallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $fuelPriceCAN_Liter;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceUS_Gallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceUS_Liter;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceCAN_Gallon;
    
    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
     */
    protected $defPriceCAN_Liter;
    
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
     * Set fuelPriceUSGallon
     *
     * @param string $fuelPriceUSGallon
     *
     * @return Fuel
     */
    public function setFuelPriceUSGallon($fuelPriceUSGallon)
    {
        $this->fuelPriceUS_Gallon = $fuelPriceUSGallon;

        return $this;
    }

    /**
     * Get fuelPriceUSGallon
     *
     * @return string
     */
    public function getFuelPriceUSGallon()
    {
        return $this->fuelPriceUS_Gallon;
    }

    /**
     * Set fuelPriceUSLiter
     *
     * @param string $fuelPriceUSLiter
     *
     * @return Fuel
     */
    public function setFuelPriceUSLiter($fuelPriceUSLiter)
    {
        $this->fuelPriceUS_Liter = $fuelPriceUSLiter;

        return $this;
    }

    /**
     * Get fuelPriceUSLiter
     *
     * @return string
     */
    public function getFuelPriceUSLiter()
    {
        return $this->fuelPriceUS_Liter;
    }

    /**
     * Set fuelPriceCANGallon
     *
     * @param string $fuelPriceCANGallon
     *
     * @return Fuel
     */
    public function setFuelPriceCANGallon($fuelPriceCANGallon)
    {
        $this->fuelPriceCAN_Gallon = $fuelPriceCANGallon;

        return $this;
    }

    /**
     * Get fuelPriceCANGallon
     *
     * @return string
     */
    public function getFuelPriceCANGallon()
    {
        return $this->fuelPriceCAN_Gallon;
    }

    /**
     * Set fuelPriceCANLiter
     *
     * @param string $fuelPriceCANLiter
     *
     * @return Fuel
     */
    public function setFuelPriceCANLiter($fuelPriceCANLiter)
    {
        $this->fuelPriceCAN_Liter = $fuelPriceCANLiter;

        return $this;
    }

    /**
     * Get fuelPriceCANLiter
     *
     * @return string
     */
    public function getFuelPriceCANLiter()
    {
        return $this->fuelPriceCAN_Liter;
    }

    /**
     * Set defPriceUSGallon
     *
     * @param string $defPriceUSGallon
     *
     * @return Fuel
     */
    public function setDefPriceUSGallon($defPriceUSGallon)
    {
        $this->defPriceUS_Gallon = $defPriceUSGallon;

        return $this;
    }

    /**
     * Get defPriceUSGallon
     *
     * @return string
     */
    public function getDefPriceUSGallon()
    {
        return $this->defPriceUS_Gallon;
    }

    /**
     * Set defPriceUSLiter
     *
     * @param string $defPriceUSLiter
     *
     * @return Fuel
     */
    public function setDefPriceUSLiter($defPriceUSLiter)
    {
        $this->defPriceUS_Liter = $defPriceUSLiter;

        return $this;
    }

    /**
     * Get defPriceUSLiter
     *
     * @return string
     */
    public function getDefPriceUSLiter()
    {
        return $this->defPriceUS_Liter;
    }

    /**
     * Set defPriceCANGallon
     *
     * @param string $defPriceCANGallon
     *
     * @return Fuel
     */
    public function setDefPriceCANGallon($defPriceCANGallon)
    {
        $this->defPriceCAN_Gallon = $defPriceCANGallon;

        return $this;
    }

    /**
     * Get defPriceCANGallon
     *
     * @return string
     */
    public function getDefPriceCANGallon()
    {
        return $this->defPriceCAN_Gallon;
    }

    /**
     * Set defPriceCANLiter
     *
     * @param string $defPriceCANLiter
     *
     * @return Fuel
     */
    public function setDefPriceCANLiter($defPriceCANLiter)
    {
        $this->defPriceCAN_Liter = $defPriceCANLiter;

        return $this;
    }

    /**
     * Get defPriceCANLiter
     *
     * @return string
     */
    public function getDefPriceCANLiter()
    {
        return $this->defPriceCAN_Liter;
    }

    /**
     * Set defPercentageRate
     *
     * @param string $defPercentageRate
     *
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
}
