<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency", options={"collate":"utf8_unicode_ci", "charset":"utf8", "engine":"InnoDB"})
 */
class Currency
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
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=false, options={"collation":"utf8_unicode_ci"})
     */
    protected $currency;

    /**
     * @var decimal
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $conversion;
    
    /**
     * @var int
     * 
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    protected $conversionBasedFrom;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean", length=4, nullable=true)
     */
    protected $isDefault;

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
     * Set currency
     *
     * @param string $currency
     *
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
     * Set conversion
     *
     * @param string $conversion
     *
     * @return Currency
     */
    public function setConversion($conversion)
    {
        $this->conversion = $conversion;

        return $this;
    }

    /**
     * Get conversion
     *
     * @return string
     */
    public function getConversion()
    {
        return $this->conversion;
    }

    /**
     * Set conversionBasedFrom
     *
     * @param integer $conversionBasedFrom
     *
     * @return Currency
     */
    public function setConversionBasedFrom($conversionBasedFrom)
    {
        $this->conversionBasedFrom = $conversionBasedFrom;

        return $this;
    }

    /**
     * Get conversionBasedFrom
     *
     * @return integer
     */
    public function getConversionBasedFrom()
    {
        return $this->conversionBasedFrom;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     *
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
}
