<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\AbstractController;

class AdminTestController extends AbstractController
{
    public function indexAction()
    {
        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        $currency = $this->getDoctrine()
            ->getRepository('AppBundle:Currency')
            ->findAll();
        
        return $this->render(':Admin:admin_calculator.html.twig', array( 'workingcondition' => $workingcondition, 'currency' => $currency ));
    }
}
