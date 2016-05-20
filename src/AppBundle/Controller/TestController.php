<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\WorkingconditionTask;
use AppBundle\Form\WorkingconditionTaskType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Workingcondition;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        
        $taskWork = new WorkingconditionTask();
        
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

            foreach ($formWorkingcondition->getData()->getForms() as $value) {
                
                $workingconditionNew = $request->request->get('new_workingcondition');
                $multiplierNew = $request->request->get('new_multiplier');
                $isDefaultNew = $request->request->get('new_isDefault');
                $isActiveNew = $request->request->get('new_isActive');
                
                if( !empty($workingconditionNew) && !empty($multiplierNew) ) {
                    
                    $conditionNew = new Workingcondition();
                    
                    $conditionNew->setWorkingcondition($workingconditionNew);
                    $conditionNew->setMultiplier($multiplierNew);
                    $conditionNew->setIsdefault($isDefaultNew);
                    $conditionNew->setIsactive($isActiveNew);
                    $conditionNew->setCreatedat(new \DateTime("now"));
                    $conditionNew->setUpdatedat(new \DateTime("now"));
                    
                    $em->persist($conditionNew);
                    $em->flush();
                }

                $record = $em->getRepository('AppBundle:Workingcondition')->findOneById($value->getId());
                
                $record->setWorkingcondition($value->getWorkingcondition());
                $record->setMultiplier($value->getMultiplier());
                $record->setIsdefault($value->getIsdefault());
                $record->setIsactive($value->getIsactive());
                
                $em->persist($record);
                $em->flush();
                
                return $this->redirect($this->generateUrl('calculator_show'));
            }
        }
        
        $workingcondition = $this->getDoctrine()
            ->getRepository('AppBundle:Workingcondition')
            ->findAll();
        
        return $this->render('Admin/calculator.html.twig', array( 'formWorkingcondition' => $formWorkingcondition->createView(), 'workingcondition' => $workingcondition ));
    }
}