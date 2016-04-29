<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Task1
{
    protected $forms;

    public function __construct()
    {
        $this->forms = new ArrayCollection();
    }
    
    public function getForms()
    {
        return $this->forms;
    }
}