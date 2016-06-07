<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Model;
use AppBundle\Entity\ModelTask;
use AppBundle\Entity\ProductTask;
use AppBundle\Form\ProductTaskType;

class ConfigController extends AbstractController
{
public function showAction(Request $request)
    {

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
                    
                    $activeProduct = $this->container->get('admin_config')->products($activeModel, $product);

                    $productTask->getForms()->add($activeProduct);


                } else {
                    $productTask->getForms()->add($product);
                }
            }
        }

        $tiers = $this->getDoctrine()->getRepository('AppBundle:Tier')->findAll();

        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'tiers' => $tiers ));
    }
    
    
    public function productAction($product) {

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
                        }
                    }

                    $modelActiveId = $modelActive->getId();

                    $modelTierActive = $this->getDoctrine()->getRepository('AppBundle:ModelTier')->findByModel($modelActiveId);

                    $activeModel = $this->container->get('admin_config')->tier($models, $modelTierActive);

                    $activeProduct = $this->container->get('admin_config')->products($activeModel, $value);

                    $productTask->getForms()->add($activeProduct);
                }

            } else {
                $productTask->getForms()->add($value);
            }
        }

        $tiers = $this->getDoctrine()->getRepository('AppBundle:Tier')->findAll();

        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'tiers' => $tiers ));
    }
    
    public function modelAction($product, $model){

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


        $tiers = $this->getDoctrine()->getRepository('AppBundle:Tier')->findAll();
        


        $formProduct = $this->createForm(ProductTaskType::class, $productTask, array(
            'action' => $this->generateUrl('config_show')
        ));

        return $this->render('Admin/config.html.twig', array( 'formProduct' => $formProduct->createView(), 'tiers' => $tiers ));
    }
}
