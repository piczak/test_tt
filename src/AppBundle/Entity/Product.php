<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product", options={"collate":"utf8_unicode_ci", "charset":"utf8", "engine":"InnoDB"})
 */
class Product
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
    protected $product;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8_unicode_ci"})
     */
    protected $url_name;
    
    /**
     * @ORM\OneToMany(targetEntity="Model", mappedBy="product")
     */
    private $models;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean", length=4, nullable=false)
     */
    protected $isActive;
    
    /**
     * @var int
     * 
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    protected $orderKey;

    /**
     * @var \DateTime $createdAt
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';
    
    /**
     * @var \DateTime $updatedAt
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updatedAt = 'CURRENT_TIMESTAMP';
    
    public function __construct() {
        $this->features = new ArrayCollection();
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
     * Set product
     *
     * @param string $product
     *
     * @return Product
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set urlName
     *
     * @param string $urlName
     *
     * @return Product
     */
    public function setUrlName($urlName)
    {
        $this->url_name = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->url_name;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set orderKey
     *
     * @param integer $orderKey
     *
     * @return Product
     */
    public function setOrderKey($orderKey)
    {
        $this->orderKey = $orderKey;

        return $this;
    }

    /**
     * Get orderKey
     *
     * @return integer
     */
    public function getOrderKey()
    {
        return $this->orderKey;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add model
     *
     * @param \AppBundle\Entity\Model $model
     *
     * @return Product
     */
    public function addModel(\AppBundle\Entity\Model $model)
    {
        $this->models[] = $model;

        return $this;
    }

    /**
     * Remove model
     *
     * @param \AppBundle\Entity\Model $model
     */
    public function removeModel(\AppBundle\Entity\Model $model)
    {
        $this->models->removeElement($model);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModels()
    {
        return $this->models;
    }
}
