<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sqtparts
 *
 * @ORM\Table(name="sqtparts", indexes={@ORM\Index(name="fk_sqtparts_modelTier_id", columns={"model_tier_id"}), @ORM\Index(name="sqtLabor_id", columns={"sqtHours_Costs_id"})})
 * @ORM\Entity
 */
class Sqtparts
{
    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255, nullable=false)
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceInterval", type="text", length=65535, nullable=false)
     */
    private $serviceinterval;

    /**
     * @var string
     *
     * @ORM\Column(name="workDescription", type="text", length=65535, nullable=false)
     */
    private $workdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="partNumber", type="string", length=255, nullable=false)
     */
    private $partnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="partDescription", type="string", length=255, nullable=false)
     */
    private $partdescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dealerNet_USD", type="decimal", precision=19, scale=4, nullable=false)
     */
    private $dealernetUsd = '0.0000';

    /**
     * @var string
     *
     * @ORM\Column(name="dealerNet_CAN", type="decimal", precision=19, scale=4, nullable=false)
     */
    private $dealernetCan = '0.0000';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\SqthoursCosts
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SqthoursCosts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sqtHours_Costs_id", referencedColumnName="id")
     * })
     */
    private $sqthoursCosts;

    /**
     * @var \AppBundle\Entity\ModelTier
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ModelTier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_tier_id", referencedColumnName="id")
     * })
     */
    private $modelTier;



    /**
     * Set product
     *
     * @param string $product
     *
     * @return Sqtparts
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
     * Set model
     *
     * @param string $model
     *
     * @return Sqtparts
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
     * Set serviceinterval
     *
     * @param string $serviceinterval
     *
     * @return Sqtparts
     */
    public function setServiceinterval($serviceinterval)
    {
        $this->serviceinterval = $serviceinterval;

        return $this;
    }

    /**
     * Get serviceinterval
     *
     * @return string
     */
    public function getServiceinterval()
    {
        return $this->serviceinterval;
    }

    /**
     * Set workdescription
     *
     * @param string $workdescription
     *
     * @return Sqtparts
     */
    public function setWorkdescription($workdescription)
    {
        $this->workdescription = $workdescription;

        return $this;
    }

    /**
     * Get workdescription
     *
     * @return string
     */
    public function getWorkdescription()
    {
        return $this->workdescription;
    }

    /**
     * Set partnumber
     *
     * @param string $partnumber
     *
     * @return Sqtparts
     */
    public function setPartnumber($partnumber)
    {
        $this->partnumber = $partnumber;

        return $this;
    }

    /**
     * Get partnumber
     *
     * @return string
     */
    public function getPartnumber()
    {
        return $this->partnumber;
    }

    /**
     * Set partdescription
     *
     * @param string $partdescription
     *
     * @return Sqtparts
     */
    public function setPartdescription($partdescription)
    {
        $this->partdescription = $partdescription;

        return $this;
    }

    /**
     * Get partdescription
     *
     * @return string
     */
    public function getPartdescription()
    {
        return $this->partdescription;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Sqtparts
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dealernetUsd
     *
     * @param string $dealernetUsd
     *
     * @return Sqtparts
     */
    public function setDealernetUsd($dealernetUsd)
    {
        $this->dealernetUsd = $dealernetUsd;

        return $this;
    }

    /**
     * Get dealernetUsd
     *
     * @return string
     */
    public function getDealernetUsd()
    {
        return $this->dealernetUsd;
    }

    /**
     * Set dealernetCan
     *
     * @param string $dealernetCan
     *
     * @return Sqtparts
     */
    public function setDealernetCan($dealernetCan)
    {
        $this->dealernetCan = $dealernetCan;

        return $this;
    }

    /**
     * Get dealernetCan
     *
     * @return string
     */
    public function getDealernetCan()
    {
        return $this->dealernetCan;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Sqtparts
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
     * @return Sqtparts
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

    /**
     * Set sqthoursCosts
     *
     * @param \AppBundle\Entity\SqthoursCosts $sqthoursCosts
     *
     * @return Sqtparts
     */
    public function setSqthoursCosts(\AppBundle\Entity\SqthoursCosts $sqthoursCosts = null)
    {
        $this->sqthoursCosts = $sqthoursCosts;

        return $this;
    }

    /**
     * Get sqthoursCosts
     *
     * @return \AppBundle\Entity\SqthoursCosts
     */
    public function getSqthoursCosts()
    {
        return $this->sqthoursCosts;
    }

    /**
     * Set modelTier
     *
     * @param \AppBundle\Entity\ModelTier $modelTier
     *
     * @return Sqtparts
     */
    public function setModelTier(\AppBundle\Entity\ModelTier $modelTier = null)
    {
        $this->modelTier = $modelTier;

        return $this;
    }

    /**
     * Get modelTier
     *
     * @return \AppBundle\Entity\ModelTier
     */
    public function getModelTier()
    {
        return $this->modelTier;
    }
}
