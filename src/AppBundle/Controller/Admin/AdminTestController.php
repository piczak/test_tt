<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Task;
use AppBundle\Entity\Task1;
use AppBundle\Form\TaskType;
use AppBundle\Form\Task1Type;
use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Workingcondition;
use AppBundle\Form\WorkingconditionType;
use Symfony\Component\HttpFoundation\Request;

class AdminTestController extends AbstractController
{
    public function indexAction(Request $request)
    {   
        
        $taskWork = new Task();
        
        $taskPrice = new Task1();
        
        $em = $this->getDoctrine()->getManager();
        
        $work = $this->getDoctrine()->getRepository('AppBundle:Workingcondition')->findAll();
        
        foreach($work as $value){
            $taskWork->getForms()->add($value);
        }

        $form = $this->createForm(TaskType::class, $taskWork, array(
            'action' => $this->generateUrl('admin_calculator_page')
        ));

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            foreach ($form->getData() as $value) {
                $id = $value->getId();
                $workingcondition = $value->get('workingcondition')->getData();

                $work_cond = $em->getRepository('AppBundle:Workingcondition')->findById($id);

                $work_cond['0']->setMultiplier($form->get('multiplier')->getData());
                $work_cond['0']->setIsdefault($form->get('isdefault')->getData());

                $em->flush();

            }
        }
        
        $price = $this->getDoctrine()->getRepository('AppBundle:Fuel')->findAll();
        
        foreach($price as $value){
            $taskPrice->getForms()->add($value);
        }
        
        $formPrice = $this->createForm(Task1Type::class, $taskPrice, array(
            'action' => $this->generateUrl('admin_calculator_page')
        ));
        
        $formPrice->handleRequest($request);
        
        if ($formPrice->isValid()) {
            foreach ($formPrice->getData() as $value) {
                $id = $value->getId();
                dump($id);
                die();
                $fuel1 = $em->getRepository('AppBundle:Fuel')->findById($id);
                $fuel1->setFuelPriceGallon($formPrice->get('fuelPriceGallon')->getData());
                $fuel1->setFuelPriceLiter($formPrice->get('fuelPriceLiter')->getData());
                $fuel1->setDefPriceGallon($formPrice->get('defPriceGallon')->getData());
                $fuel1->setDefPriceLiter($formPrice->get('defPriceLiter')->getData());
                $em->flush();
            }
        }
        

        $em->flush(); 

        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        $currency = $this->getDoctrine()
            ->getRepository('AppBundle:Currency')
            ->findAll();

        return $this->render(':Admin:admin_calculator.html.twig', array( 'form' => $form->createView(), 'formPrice' => $formPrice->createView(), 'workingcondition' => $workingcondition, 'currency' => $currency ));
    }
}
