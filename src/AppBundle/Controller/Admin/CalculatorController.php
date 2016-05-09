<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\WorkingconditionTask;
use AppBundle\Entity\FuelTask;
use AppBundle\Entity\Fuel;
use AppBundle\Entity\Currency;
use AppBundle\Form\WorkingconditionTaskType;
use AppBundle\Form\FuelTaskType;
use AppBundle\Form\CurrencyType;
use AppBundle\Form\RateType;
use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CalculatorController extends AbstractController
{
    public function showAction(Request $request)
    {   
        
        $taskWork = new WorkingconditionTask();
        
        $taskPrice = new FuelTask();
        
        $currencyInsert = new Currency();

        $fuelInsert = new Fuel();
        
        $em = $this->getDoctrine()->getManager();

        //edit working condition
        $work = $this->getDoctrine()->getRepository('AppBundle:Workingcondition')->findAll();
        
        foreach($work as $value){
            $taskWork->getForms()->add($value);
        }

        $formWorkingcondition = $this->createForm(WorkingconditionTaskType::class, $taskWork, array(
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
        
        //edit fuel prices/def and choosing default currency
        $price = $this->getDoctrine()->getRepository('AppBundle:Currency')->findAll();
        
        foreach($price as $value){
            $taskPrice->getForms()->add($value);
        }
        
        $formPrice = $this->createForm(FuelTaskType::class, $taskPrice, array(
            'action' => $this->generateUrl('calculator_show')
        ));
        
        $formPrice->handleRequest($request);
        
        //remove currency group
        if ($formPrice->isValid()) {
            $parameters = $request->request->all();
            $remove = $parameters[$formPrice->getName()]['forms'];

            $i = 0;
            foreach ($formPrice->getData()->getForms() as $value) {

                if(array_key_exists('remove', $remove[$i])) {
                    $currency_price_to_remove = $em->getRepository('AppBundle:Currency')->findById($value->getId());
                    $em->remove($currency_price_to_remove[0]);
                    $em->flush(); 
                }
                $i++;
            }
            return $this->redirect($this->generateUrl('calculator_show'));
        }
        
        //add new currency and prices
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
        
        #change rate
        $formRate = $this->createForm(RateType::class, $fuelInsert, array(
            'action' => $this->generateUrl('calculator_show')
        ));
        $formRate->handleRequest($request);
        
        if ($formRate->isValid()) {
            foreach($this->getDoctrine()->getRepository('AppBundle:Fuel')->findAll() as $value ) {
                $value->setDefPercentageRate($formRate->getData()->getDefPercentageRate());
                $em->persist($value);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('calculator_show'));
        }
        

        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        $currency = $this->getDoctrine()
            ->getRepository('AppBundle:Currency')
            ->findAll();

        return $this->render(':Admin:calculator.html.twig', array( 'formRate' => $formRate->createView(), 'formCurrency' => $formCurrency->createView(), 'formWorkingcondition' => $formWorkingcondition->createView(), 'formPrice' => $formPrice->createView(), 'workingcondition' => $workingcondition, 'currency' => $currency ));
    }
}
