<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="model", options={"collate":"utf8_unicode_ci", "charset":"utf8", "engine":"InnoDB"})
 */
class Model
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
    protected $model;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=false, options={"collation":"utf8_unicode_ci"})
     */
    protected $url_name;
    
    /**
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="models")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", columnDefinition="INT NOT NULL AFTER `url_name`")
     */
    protected $product;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean", length=4, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';
    
    /**
     * @var \DateTime $updatedAt
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt = 'CURRENT_TIMESTAMP';

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
     * Set model
     *
     * @param string $model
     *
     * @return Model
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set urlName
     *
     * @param string $urlName
     *
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Model
     */
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
