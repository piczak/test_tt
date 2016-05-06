<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Task;
use AppBundle\Entity\Task1;
use AppBundle\Entity\Fuel;
use AppBundle\Entity\Currency;
use AppBundle\Form\TaskType;
use AppBundle\Form\Task1Type;
use AppBundle\Form\CurrencyType;
use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Workingcondition;
use AppBundle\Form\WorkingconditionType;
use Symfony\Component\HttpFoundation\Request;

class CalculatorController extends AbstractController
{
    public function showAction(Request $request)
    {   
        
        $taskWork = new Task();
        
        $taskPrice = new Task1();
        
        $em = $this->getDoctrine()->getManager();
        
        $work = $this->getDoctrine()->getRepository('AppBundle:Workingcondition')->findAll();
        
        foreach($work as $value){
            $taskWork->getForms()->add($value);
        }

        $formWorkingcondition = $this->createForm(TaskType::class, $taskWork, array(
            'action' => $this->generateUrl('calculator_show')
        ));

        $formWorkingcondition->handleRequest($request);
        
        if ($formWorkingcondition->isValid()) {
            foreach ($formWorkingcondition->getData() as $value) {
                $id = $value->getId();
                $workingcondition = $value->get('workingcondition')->getData();

                $work_cond = $em->getRepository('AppBundle:Workingcondition')->findById($id);

                $work_cond['0']->setMultiplier($formWorkingcondition->get('multiplier')->getData());
                $work_cond['0']->setIsdefault($formWorkingcondition->get('isdefault')->getData());

                $em->persist($work_cond);
                $em->flush();
                
                return $this->redirect($this->generateUrl('calculator_show'));

            }
        }

        $price = $this->getDoctrine()->getRepository('AppBundle:Currency')->findAll();
        
        foreach($price as $value){
            $taskPrice->getForms()->add($value);
        }
        
        $formPrice = $this->createForm(Task1Type::class, $taskPrice, array(
            'action' => $this->generateUrl('calculator_show')
        ));
        
        $formPrice->handleRequest($request);
        
//        if ($formPrice->isValid()) {
//            dump($formPrice->getChildren());die;
////            dump($formPrice->get('remove')->getData());die;
//            foreach ($formPrice->getData()->getForms() as $value) {
//                dump($value);
//                die();
//            }
//            return $this->redirect($this->generateUrl('calculator_show'));
//        }
        
        
        
        $currencyInsert = new Currency();
        
        $formCurrency = $this->createForm(CurrencyType::class, $currencyInsert, array(
            'action' => $this->generateUrl('calculator_show')
        ));
        
        $formCurrency->handleRequest($request);
        
        if ($formCurrency->isValid()) {
            
            $qb = $this->getDoctrine()->getRepository('AppBundle:Currency')->createQueryBuilder('p')
                ->join('p.fuelId', 'f')
                ->where('p.isDefault = :isDefault')
                ->select('f.defPercentageRate')
                ->setParameter('isDefault', '1')
                ->getQuery();
        
            $defPercentageRate = $qb->getResult()['0']['defPercentageRate'];

            $currencyInsert->setCurrency($formCurrency->get('currency')->getData());
            $currencyInsert->setRegion($formCurrency->get('region')->getData());
            
            if ($formCurrency->get('isDefault')->getData() === true) {
                $default = $this->getDoctrine()->getRepository('AppBundle:Currency')->findOneByIsDefault('1');
                $default->setIsDefault('0');
            }
            
            $currencyInsert->setIsDefault($formCurrency->get('isDefault')->getData());
            
            $currencyInsert->getFuelId()->setFuelPriceGallon($formCurrency->getData()->getFuelId()->getFuelPriceGallon());
            $currencyInsert->getFuelId()->setFuelPriceLiter($formCurrency->getData()->getFuelId()->getFuelPriceLiter());
            $currencyInsert->getFuelId()->setDefPriceGallon($formCurrency->getData()->getFuelId()->getDefPriceGallon());
            $currencyInsert->getFuelId()->setDefPriceLiter($formCurrency->getData()->getFuelId()->getDefPriceLiter());
        
            $currencyInsert->getFuelId()->setDefPercentageRate($defPercentageRate);
            
            $em->persist($currencyInsert);
            $em->flush();
            
            unset($currencyInsert);
            
            return $this->redirect($this->generateUrl('calculator_show'));
            
        }
        
//        $def = new Fuel();
//        
//        $formDef = $this->createForm(new DefType(), $def, array(
//            'action' => $this->generateUrl('calculator_show')
//        ));
//        
////        if ($formDef->handleRequest($request)->isSubmitted() && $formDef->isValid()) {
////            $fuelData = $this->getDoctrine()->getRepository('AppBundle:Fuel')->findAll();
////            foreach($fuelData){
////        }
        
        
        
        $em->flush(); 
        
        
        
        
        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        $currency = $this->getDoctrine()
            ->getRepository('AppBundle:Currency')
            ->findAll();

        return $this->render(':Admin:calculator.html.twig', array( 'formCurrency' => $formCurrency->createView(), 'formWorkingcondition' => $formWorkingcondition->createView(), 'formPrice' => $formPrice->createView(), 'workingcondition' => $workingcondition, 'currency' => $currency ));
    }
}
