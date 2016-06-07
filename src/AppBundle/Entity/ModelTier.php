<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModelTier
 *
 * @ORM\Table(name="model_tier", indexes={@ORM\Index(name="model_id", columns={"model_id"}), @ORM\Index(name="tier_id", columns={"tier_id"}), @ORM\Index(name="model_id_2", columns={"model_id"}), @ORM\Index(name="tier_id_2", columns={"tier_id"})})
 * @ORM\Entity
 */
class ModelTier
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefaultTier", type="boolean", nullable=false)
     */
    private $isdefaulttier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=false)
     */
    private $isactive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isProCare", type="boolean", nullable=false)
     */
    private $isprocare;

    /**
     * @var string
     *
     * @ORM\Column(name="fuelUsage_gallon_hour", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $fuelusageGallonHour;

    /**
     * @var string
     *
     * @ORM\Column(name="fuelUsage_liter_hour", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $fuelusageLiterHour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isSCR", type="boolean", nullable=false)
     */
    private $isscr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isWithTires", type="boolean", nullable=false)
     */
    private $iswithtires;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isWithTracks", type="boolean", nullable=false)
     */
    private $iswithtracks;

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
     * @var \AppBundle\Entity\Model
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Model")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     * })
     */
    private $model;

    /**
     * @var \AppBundle\Entity\Tier
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tier", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tier_id", referencedColumnName="id")
     * })
     */
    private $tier;


    /**
     * Set isdefaulttier
     *
     * @param boolean $isdefaulttier
     *
     * @return ModelTier
     */
    public function setIsdefaulttier($isdefaulttier)
    {
        $this->isdefaulttier = $isdefaulttier;

        return $this;
    }

    /**
     * Get isdefaulttier
     *
     * @return boolean
     */
    public function getIsdefaulttier()
    {
        return $this->isdefaulttier;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return ModelTier
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return boolean
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set isprocare
     *
     * @param boolean $isprocare
     *
     * @return ModelTier
     */
    public function setIsprocare($isprocare)
    {
        $this->isprocare = $isprocare;

        return $this;
    }

    /**
     * Get isprocare
     *
     * @return boolean
     */
    public function getIsprocare()
    {
        return $this->isprocare;
    }

    /**
     * Set fuelusageGallonHour
     *
     * @param string $fuelusageGallonHour
     *
     * @return ModelTier
     */
    public function setFuelusageGallonHour($fuelusageGallonHour)
    {
        $this->fuelusageGallonHour = $fuelusageGallonHour;

        return $this;
    }

    /**
     * Get fuelusageGallonHour
     *
     * @return string
     */
    public function getFuelusageGallonHour()
    {
        return $this->fuelusageGallonHour;
    }

    /**
     * Set fuelusageLiterHour
     *
     * @param string $fuelusageLiterHour
     *
     * @return ModelTier
     */
    public function setFuelusageLiterHour($fuelusageLiterHour)
    {
        $this->fuelusageLiterHour = $fuelusageLiterHour;

        return $this;
    }

    /**
     * Get fuelusageLiterHour
     *
     * @return string
     */
    public function getFuelusageLiterHour()
    {
        return $this->fuelusageLiterHour;
    }

    /**
     * Set isscr
     *
     * @param boolean $isscr
     *
     * @return ModelTier
     */
    public function setIsscr($isscr)
    {
        $this->isscr = $isscr;

        return $this;
    }

    /**
     * Get isscr
     *
     * @return boolean
     */
    public function getIsscr()
    {
        return $this->isscr;
    }

    /**
     * Set iswithtires
     *
     * @param boolean $iswithtires
     *
     * @return ModelTier
     */
    public function setIswithtires($iswithtires)
    {
        $this->iswithtires = $iswithtires;

        return $this;
    }

    /**
     * Get iswithtires
     *
     * @return boolean
     */
    public function getIswithtires()
    {
        return $this->iswithtires;
    }

    /**
     * Set iswithtracks
     *
     * @param boolean $iswithtracks
     *
     * @return ModelTier
     */
    public function setIswithtracks($iswithtracks)
    {
        $this->iswithtracks = $iswithtracks;

        return $this;
    }

    /**
     * Get iswithtracks
     *
     * @return boolean
     */
    public function getIswithtracks()
    {
        return $this->iswithtracks;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return ModelTier
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
     * @return ModelTier
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
     * Set model
     *
     * @param \AppBundle\Entity\Model $model
     *
     * @return ModelTier
     */
    public function setModel(\AppBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \AppBundle\Entity\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set tier
     *
     * @param \AppBundle\Entity\Tier $tier
     *
     * @return ModelTier
     */
    public function setTier(\AppBundle\Entity\Tier $tier = null)
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * Get tier
     *
     * @return \AppBundle\Entity\Tier
     */
    public function getTier()
    {
        return $this->tier;
    }
}
