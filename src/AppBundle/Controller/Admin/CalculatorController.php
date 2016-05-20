<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\WorkingconditionTask;
use AppBundle\Entity\Workingcondition;
use AppBundle\Form\WorkingconditionTaskType;
use AppBundle\Entity\FuelTask;
use AppBundle\Entity\Fuel;
use AppBundle\Entity\Currency;
use AppBundle\Form\FuelTaskType;
use AppBundle\Form\RateType;

class CalculatorController extends AbstractController
{
public function showAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
    
        //Workingcondition
        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        $taskWork = new WorkingconditionTask();

        foreach($workingcondition as $value){
            $taskWork->getForms()->add($value);
        }

        $formWorkingcondition = $this->createForm(WorkingconditionTaskType::class, $taskWork, array(
            'action' => $this->generateUrl('calculator_show')
        ));

        $formWorkingcondition->handleRequest($request);
        
        if ($formWorkingcondition->isValid()) {
            
            $conditionNew = new Workingcondition();
            
            foreach ($formWorkingcondition->getData()->getForms() as $value) {
                
                $workingconditionNew = $request->request->get('new_workingcondition');
                $multiplierNew = $request->request->get('new_multiplier');
                $isDefaultNew = $request->request->get('new_isDefault');
                $isActiveNew = $request->request->get('new_isActive');
                
                if( !empty($workingconditionNew) && !empty($multiplierNew) ) {
                    
                    $conditionNew->setWorkingcondition($workingconditionNew);
                    $conditionNew->setMultiplier($multiplierNew);
                    $conditionNew->setIsdefault($isDefaultNew);
                    $conditionNew->setIsactive($isActiveNew);
                    $conditionNew->setCreatedat(new \DateTime("now"));
                    $conditionNew->setUpdatedat(new \DateTime("now"));
                }

                $record = $em->getRepository('AppBundle:Workingcondition')->findOneById($value->getId());
                
                $record->setWorkingcondition($value->getWorkingcondition());
                $record->setMultiplier($value->getMultiplier());
                $record->setIsdefault($value->getIsdefault());
                $record->setIsactive($value->getIsactive());
                
                $em->persist($record);
                $em->flush();
                
            }
                if( !empty($workingconditionNew) && !empty($multiplierNew) ) {
                    $em->persist($conditionNew);
                    $em->flush();
                }
                
            
            return $this->redirect($this->generateUrl('calculator_show'));
        }
        
        
        //----------------------------------------------------------------------
        
        //start edit fuel prices/def and choosing default currency
        $taskPrice = new FuelTask();
        
        $price = $this->getDoctrine()
            ->getRepository('AppBundle:Currency')
            ->findAll();
        
        foreach($price as $value){
            $taskPrice->getForms()->add($value);
        }
        
        $formPrice = $this->createForm(FuelTaskType::class, $taskPrice, array(
            'action' => $this->generateUrl('calculator_show')
        ));
        
        $formPrice->handleRequest($request);
        
        //change:(fuel-table: fuel/def prices, currency-table: isDefault option )
        if ($formPrice->isValid()) {

            foreach ($formPrice->getData()->getForms() as $value) {
                
                $record = $em->getRepository('AppBundle:Currency')->findOneById($value->getId());
                
                $record->setIsdefault($value->getIsdefault());
                $record->getFuelId()->setFuelPriceGallon($value->getFuelId()->getFuelPriceGallon());
                $record->getFuelId()->setFuelPriceLiter($value->getFuelId()->getFuelPriceLiter());
                $record->getFuelId()->setDefPriceGallon($value->getFuelId()->getDefPriceGallon());
                $record->getFuelId()->setDefPriceLiter($value->getFuelId()->getDefPriceLiter());
                
                $em->persist($record);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('calculator_show'));
        }
        //end edit fuel
        
        //----------------------------------------------------------------------
        
        //change rate
        $fuel = new Fuel();
        
        $rate = $this->getDoctrine()
            ->getRepository('AppBundle:Fuel')
            ->findOneById('1');
        
        $fuel->setDefPercentageRate($rate->getDefPercentageRate());
        
        $formRate = $this->createForm(RateType::class, $fuel, array(
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
        
        return $this->render('Admin/calculator.html.twig', array( 'formWorkingcondition' => $formWorkingcondition->createView(), 'formPrice' => $formPrice->createView(), 'formRate' => $formRate->createView() ));
    }
}
