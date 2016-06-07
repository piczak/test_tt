<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Currency;
use AppBundle\Form\Currency2Type;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends AbstractController{

    
    public function newAction(Request $request)
    {
        $entity = new Currency();
        $form = $this->createCreateForm($entity);

        return $this->render('Test/ajax.html.twig',
                        array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

    public function createAction(Request $request)
    {

        $entity = new Currency();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->render('Test/ajax.html.twig',
                        array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
            );
        }

        $response = new JsonResponse(
                array(
            'message' => 'Error',
            'form' => $this->renderView('Test/ajax_form.html.twig',
                    array(
                'entity' => $entity,
                'form' => $form->createView(),
            ))), 400);

        return $response;
    }

    /**
     * Creates a form to create a Demo entity.
     *
     * @param Demo $entity The entity
     *
     * @return SymfonyComponentFormForm The form
     */
    private function createCreateForm(Currency $entity)
    {
        $form = $this->createForm(new Currency2Type(), $entity,
                array(
            'action' => $this->generateUrl('ajax_create')
        ));

        return $form;
    }
}