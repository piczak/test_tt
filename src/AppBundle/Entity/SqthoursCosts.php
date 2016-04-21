<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SqthoursCosts
 *
 * @ORM\Table(name="sqthours_costs")
 * @ORM\Entity
 */
class SqthoursCosts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="model_tier_id", type="integer", nullable=true)
     */
    private $modelTierId;

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
     * @ORM\Column(name="serviceInterval", type="string", length=11, nullable=false)
     */
    private $serviceinterval;

    /**
     * @var integer
     *
     * @ORM\Column(name="serviceIntervalHours", type="integer", nullable=false)
     */
    private $serviceintervalhours;

    /**
     * @var string
     *
     * @ORM\Column(name="laborHours", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $laborhours = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="laborHoursTotal", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $laborhourstotal;

    /**
     * @var string
     *
     * @ORM\Column(name="laborHoursTotal_ProCare", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $laborhourstotalProcare;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCost_USD", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $partscostUsd;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCost_CAN", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $partscostCan;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCostTotal_USD", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $partscosttotalUsd;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCostTotal_CAN", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $partscosttotalCan;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCostTotal_ProCare_USD", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $partscosttotalProcareUsd;

    /**
     * @var string
     *
     * @ORM\Column(name="partsCostTotal_ProCare_CAN", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $partscosttotalProcareCan;

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
     * Set modelTierId
     *
     * @param integer $modelTierId
     *
     * @return SqthoursCosts
     */
    public function setModelTierId($modelTierId)
    {
        $this->modelTierId = $modelTierId;

        return $this;
    }

    /**
     * Get modelTierId
     *
     * @return integer
     */
    public function getModelTierId()
    {
        return $this->modelTierId;
    }

    /**
     * Set product
     *
     * @param string $product
     *
     * @return SqthoursCosts
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
     * @return SqthoursCosts
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
     * @return SqthoursCosts
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
     * Set serviceintervalhours
     *
     * @param integer $serviceintervalhours
     *
     * @return SqthoursCosts
     */
    public function setServiceintervalhours($serviceintervalhours)
    {
        $this->serviceintervalhours = $serviceintervalhours;

        return $this;
    }

    /**
     * Get serviceintervalhours
     *
     * @return integer
     */
    public function getServiceintervalhours()
    {
        return $this->serviceintervalhours;
    }

    /**
     * Set laborhours
     *
     * @param string $laborhours
     *
     * @return SqthoursCosts
     */
    public function setLaborhours($laborhours)
    {
        $this->laborhours = $laborhours;

        return $this;
    }

    /**
     * Get laborhours
     *
     * @return string
     */
    public function getLaborhours()
    {
        return $this->laborhours;
    }

    /**
     * Set laborhourstotal
     *
     * @param string $laborhourstotal
     *
     * @return SqthoursCosts
     */
    public function setLaborhourstotal($laborhourstotal)
    {
        $this->laborhourstotal = $laborhourstotal;

        return $this;
    }

    /**
     * Get laborhourstotal
     *
     * @return string
     */
    public function getLaborhourstotal()
    {
        return $this->laborhourstotal;
    }

    /**
     * Set laborhourstotalProcare
     *
     * @param string $laborhourstotalProcare
     *
     * @return SqthoursCosts
     */
    public function setLaborhourstotalProcare($laborhourstotalProcare)
    {
        $this->laborhourstotalProcare = $laborhourstotalProcare;

        return $this;
    }

    /**
     * Get laborhourstotalProcare
     *
     * @return string
     */
    public function getLaborhourstotalProcare()
    {
        return $this->laborhourstotalProcare;
    }

    /**
     * Set partscostUsd
     *
     * @param string $partscostUsd
     *
     * @return SqthoursCosts
     */
    public function setPartscostUsd($partscostUsd)
    {
        $this->partscostUsd = $partscostUsd;

        return $this;
    }

    /**
     * Get partscostUsd
     *
     * @return string
     */
    public function getPartscostUsd()
    {
        return $this->partscostUsd;
    }

    /**
     * Set partscostCan
     *
     * @param string $partscostCan
     *
     * @return SqthoursCosts
     */
    public function setPartscostCan($partscostCan)
    {
        $this->partscostCan = $partscostCan;

        return $this;
    }

    /**
     * Get partscostCan
     *
     * @return string
     */
    public function getPartscostCan()
    {
        return $this->partscostCan;
    }

    /**
     * Set partscosttotalUsd
     *
     * @param string $partscosttotalUsd
     *
     * @return SqthoursCosts
     */
    public function setPartscosttotalUsd($partscosttotalUsd)
    {
        $this->partscosttotalUsd = $partscosttotalUsd;

        return $this;
    }

    /**
     * Get partscosttotalUsd
     *
     * @return string
     */
    public function getPartscosttotalUsd()
    {
        return $this->partscosttotalUsd;
    }

    /**
     * Set partscosttotalCan
     *
     * @param string $partscosttotalCan
     *
     * @return SqthoursCosts
     */
    public function setPartscosttotalCan($partscosttotalCan)
    {
        $this->partscosttotalCan = $partscosttotalCan;

        return $this;
    }

    /**
     * Get partscosttotalCan
     *
     * @return string
     */
    public function getPartscosttotalCan()
    {
        return $this->partscosttotalCan;
    }

    /**
     * Set partscosttotalProcareUsd
     *
     * @param string $partscosttotalProcareUsd
     *
     * @return SqthoursCosts
     */
    public function setPartscosttotalProcareUsd($partscosttotalProcareUsd)
    {
        $this->partscosttotalProcareUsd = $partscosttotalProcareUsd;

        return $this;
    }

    /**
     * Get partscosttotalProcareUsd
     *
     * @return string
     */
    public function getPartscosttotalProcareUsd()
    {
        return $this->partscosttotalProcareUsd;
    }

    /**
     * Set partscosttotalProcareCan
     *
     * @param string $partscosttotalProcareCan
     *
     * @return SqthoursCosts
     */
    public function setPartscosttotalProcareCan($partscosttotalProcareCan)
    {
        $this->partscosttotalProcareCan = $partscosttotalProcareCan;

        return $this;
    }

    /**
     * Get partscosttotalProcareCan
     *
     * @return string
     */
    public function getPartscosttotalProcareCan()
    {
        return $this->partscosttotalProcareCan;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return SqthoursCosts
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
     * @return SqthoursCosts
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
