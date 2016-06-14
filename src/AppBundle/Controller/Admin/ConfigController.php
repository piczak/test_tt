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

                    $counter = 0;
                    $modeldefaultId = null;

                    foreach($models as $model) {

                        if ($model->getIsdefault() == 1) {
                            $counter++;
                        }
                    }

                    if ($counter == 1) {
                        foreach ($models as $model) {
                            if ($model->getIsdefault() == 1) {
                                $modeldefaultId = $model->getId();
                            }
                        }

                    } else {
                        foreach ($models as $model) {
                            if ($models['0'] == $model) {
                                $modeldefaultId = $model->getId();
                            }
                        }
                    }

                    $modelTierActive = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($modeldefaultId);

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

        if($request->isXmlHttpRequest()){
            $jsonData = $request->getContent();
            $input = json_decode($jsonData);

            print_r($input);

            if($input->type == 'product') {

                $product = $em->getRepository('AppBundle:Product')->find($input->productId);

                if(isset($input->value)) {
                    $urlName = strtolower(str_replace(' ', '-', $input->value));
                    $product->setProduct($input->value);
                    $product->setUrlName($urlName);
                }
                if (isset($input->active)) {
                    $product->setIsactive($input->active);
                }

                $em->flush();

            } else if ($input->type == 'model') {

                $model = $em->getRepository('AppBundle:Model')->find($input->modelId);

                if (isset($input->value)) {
                    $model->setModel($input->value);
                }
                if (isset($input->active)) {
                    $model->setIsactive($input->active);
                }

                $em->flush();

            } else if ($input->type == 'tier') {

                $tier = $em->getRepository('AppBundle:ModelTier')->find($input->tierId);

                if (isset($input->active)) {
                    $tier->setIsactive($input->active);
                }

                $em->flush();
            }
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
