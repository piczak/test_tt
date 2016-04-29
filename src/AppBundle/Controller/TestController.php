<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        $task = new Task();
        
        $work = $this->getDoctrine()->getRepository('AppBundle:Workingcondition')->findAll();
        
        foreach($work as $value){
            $task->getForms()->add($value);
        }

        $form = $this->createForm(TaskType::class, $task, array(
            'action' => $this->generateUrl('test')
        ));

        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        
        
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
        $em->flush();


        return $this->render('test.html.twig', array('array' => $value,
            'form' => $form->createView(),
        ));
    }
}