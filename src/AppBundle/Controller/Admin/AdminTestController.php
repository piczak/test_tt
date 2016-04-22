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
        
        $fuel = $this->getDoctrine()
            ->getRepository('AppBundle:Fuel')
            ->findAll();
        
        //dump($fuel);
        //die();
        
        return $this->render(':Admin:admin_test.html.twig', array( 'workingcondition' => $workingcondition, 'fuel' => $fuel ));
    }
}
