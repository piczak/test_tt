<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class WorkingConditionController extends Controller
{
    public function indexAction(Request $request)
    {
        $workingcondition = $this->getDoctrine()
                ->getRepository('AppBundle:Workingcondition')
                ->findAll();
        dump($workingcondition);
        die();
        
        
        
        return $this->render('default/index.html.twig');
    }
}
