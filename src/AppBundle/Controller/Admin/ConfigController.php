<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ProductTask;
use AppBundle\Form\ProductTaskType;
use AppBundle\Entity\TierTask;
use AppBundle\Form\TierTaskType;

class ConfigController extends AbstractController
{
public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tierTask = new TierTask();

        $productTask = new ProductTask();

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        $counter = 0;
        foreach ($products as $product) {
            if($product->getIsDefault() == 1) {
                $counter++;
            }
        }

        if($counter == 1) {
            foreach ($products as $product) {
                if ($product->getIsDefault() == 1){
                    $id = $product->getId();

                    $models = $this->getDoctrine()->getRepository('AppBundle:Model')->findByProduct($id);

                    $modelActive = $this->getDoctrine()->getRepository('AppBundle:Model')->findOneByIsdefault(1);

                    $modelActiveId = $modelActive->getId();

                    $modelTierActive = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($modelActiveId);

                    $activeModel = $this->container->get('admin_config')->tier($models, $modelTierActive);

                    foreach ($modelTierActive as $tier){
                        $tierTask->getForms()->add($tier);
                    }

                    $activeProduct = $this->container->get('admin_config')->products($activeModel, $product);

                    $productTask->getForms()->add($activeProduct);

                } else {
                    $productTask->getForms()->add($product);
                }
            }
        }

        
        
        
        
        
        $formTier = $this->createForm(TierTaskType::class, $tierTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        if ($request->isMethod('POST')){

            $this->container->get('admin_config')->dbInsert($request, $em);

        }

        
        
        
        
        
        
        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'formTier' => $formTier->createView() ));
    }
    
    
    public function productAction(Request $request, $product) {

        $tierTask = new TierTask();

        $tiers = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findAll();


        $productTask = new ProductTask();

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        foreach ($products as $value) {
            if ($product == $value->getUrlname() && $value->getForms() == null){
                $id = $value->getId();

                $models = $this->getDoctrine()->getRepository('AppBundle:Model')->findByProduct($id);

                if(!empty($models)) {
                    foreach ($models as $model) {
                        if ($model->getIsdefault() == 1) {
                            $modelActive = $model;

                            $id = $model->getId();

                            $tiers = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($id);
                        } else {

                            $tiers = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($id);
                        }
                    }

                    $modelActiveId = $modelActive->getId();

                    $modelTierActive = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($modelActiveId);

                    $activeModel = $this->container->get('admin_config')->tier($models, $modelTierActive);

                    $activeProduct = $this->container->get('admin_config')->products($activeModel, $value);

                    $productTask->getForms()->add($activeProduct);
                } else {
                    $productTask->getForms()->add($value);
                }

            } else {
                $productTask->getForms()->add($value);
            }
            //dump($productTask);
        }
        //die();
        foreach ($tiers as $tier){
            $tierTask->getForms()->add($tier);
        }

        $formTier = $this->createForm(TierTaskType::class, $tierTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'formTier' => $formTier->createView(), 'tiers' => $tiers ));
    }
    
    public function modelAction(Request $request, $product, $model){

        $productTask = new ProductTask();

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        foreach ($products as $value) {
            if ($product == $value->getUrlname()){
                $id = $value->getId();

                $models = $this->getDoctrine()->getRepository('AppBundle:Model')->findByProduct($id);

                $modelActive = $this->getDoctrine()->getRepository('AppBundle:Model')->findOneByModel($model);

                $modelActiveId = $modelActive->getId();

                $modelTierActive = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($modelActiveId);

                $activeModel = $this->container->get('admin_config')->model($model, $models, $modelTierActive);

                $activeProduct = $this->container->get('admin_config')->products($activeModel, $value);

                $productTask->getForms()->add($activeProduct);

            } else {
                $productTask->getForms()->add($value);
            }
        }

        $tierTask = new TierTask();

        $tiers = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findAll();

        foreach ($tiers as $tier){
            if($model == $tier->getModel()->getModel() ){

                $tierTask->getForms()->add($tier);
            }
        }

        $formTier = $this->createForm(TierTaskType::class, $tierTask, array(
            'action' => $this->generateUrl('config_show')
        ));
        

        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'formTier' => $formTier->createView(), 'tiers' => $tiers ));
    }
}
