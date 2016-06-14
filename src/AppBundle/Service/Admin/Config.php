<?php


namespace AppBundle\Service\Admin;

use AppBundle\Entity\Product;
use AppBundle\Entity\Model;
use AppBundle\Entity\ProductsTask;

/**
 * @author Kamil Klamut
 */
class Config
{
    /**
     * @var Test
     */
    private $test;


    public function __construct($test)
    {
        $this->test = $test;
    }

    public function products($activeModel, $product){

        $activeModel->setProduct($product->getProduct());
        $activeModel->setUrlName($product->getUrlName());
        $activeModel->setIsactive($product->getIsactive());
        $activeModel->setIsdefault($product->getIsdefault());
        $activeModel->setOrderkey($product->getOrderkey());
        $activeModel->setCreatedat($product->getCreatedat());
        $activeModel->setUpdatedat($product->getUpdatedat());
        $activeModel->setId($product->getId());

        return $activeModel;
    }

    public function model($model, $models, $modelTierActive){

        $modelTask = new Product();

        foreach ($models as $value) {

            if ($model == $value->getModel()) {

                $tierTask = new Model();


                foreach ($modelTierActive as $tier) {

                    $tierTask->getForms()->add($tier);
                }

                $tierTask->setModel($value->getModel());
                $tierTask->setUrlName($value->getUrlName());
                $tierTask->setIsactive($value->getIsactive());
                $tierTask->setIsdefault($value->getIsdefault());
                $tierTask->setOrderkey($value->getOrderkey());
                $tierTask->setCreatedat($value->getCreatedat());
                $tierTask->setUpdatedat($value->getUpdatedat());
                $tierTask->setId($value->getId());
                $tierTask->setProduct($value->getProduct());

                $modelTask->getForms()->add($tierTask);
            } else {
                $modelTask->getForms()->add($value);
            }

        }
        return $modelTask;
    }

    public function tier($models, $modelTierActive){

        $modelTask = new Product();

        $counter = 0;
        foreach ($models as $model) {
            if($model->getIsDefault() == 1) {
                $counter++;
            }
        }

        if( $counter == 1 ) {
            foreach ($models as $model) {

                if ($model->getIsDefault() == 1) {

                    $tierTask = new Model();

                    foreach ($modelTierActive as $tier) {
                        $tierTask->getForms()->add($tier);
                    }

                    $tierTask->setModel($model->getModel());
                    $tierTask->setUrlName($model->getUrlName());
                    $tierTask->setIsactive($model->getIsactive());
                    $tierTask->setIsdefault($model->getIsdefault());
                    $tierTask->setOrderkey($model->getOrderkey());
                    $tierTask->setCreatedat($model->getCreatedat());
                    $tierTask->setUpdatedat($model->getUpdatedat());
                    $tierTask->setId($model->getId());
                    $tierTask->setProduct($model->getProduct());

                    $modelTask->getForms()->add($tierTask);

                } else {
                    $modelTask->getForms()->add($model);
                }
            }
        } else {
            foreach ($models as $model) {

                if ($models[0] == $model) {

                    $tierTask = new Model();

                    foreach ($modelTierActive as $tier) {
                        $tierTask->getForms()->add($tier);
                    }

                    $tierTask->setModel($model->getModel());
                    $tierTask->setUrlName($model->getUrlName());
                    $tierTask->setIsactive($model->getIsactive());
                    $tierTask->setIsdefault($model->getIsdefault());
                    $tierTask->setOrderkey($model->getOrderkey());
                    $tierTask->setCreatedat($model->getCreatedat());
                    $tierTask->setUpdatedat($model->getUpdatedat());
                    $tierTask->setId($model->getId());
                    $tierTask->setProduct($model->getProduct());

                    $modelTask->getForms()->add($tierTask);
                } else {
                    $modelTask->getForms()->add($model);
                }
            }
        }
        return $modelTask;
    }

    public function dbInsert($request, $products, $models, $modelTierActive, $em) {

        $productIndex = 0;

        $productForms = $request->request->get('product_task')['forms'];

        foreach($productForms as $productForm) {


            foreach($products as $product){
                if ($products[$productIndex] == $product && $productForms[$productIndex] == $productForm ) {

                    $urlName = strtolower(str_replace(' ', '-', $productForm['product']));

                    if(array_key_exists('isActive', $productForm)){
                        $product->setIsactive($productForm['isActive']);
                    } else {
                        $product->setIsactive(0);
                    }

                    $product->setProduct($productForm['product']);
                    $product->setUrlname($urlName);

                    if(array_key_exists('forms', $productForm)){


                        $modelindex = 0 ;
                        foreach($productForm['forms'] as $modelForm) {

                            
                            foreach($models as $model) {

                                if ($models[$modelindex] == $model && $productForm['forms'][$modelindex] == $modelForm ) {

                                    $model->setModel($modelForm['model']);

                                    if(array_key_exists('isActive', $modelForm)){
                                        $model->setIsactive($modelForm['isActive']);
                                    } else {
                                        $model->setIsactive(0);
                                    }

                                    if(array_key_exists('forms', $modelForm)){

                                        $tierIndex = 0;
                                        foreach($modelTierActive as $tier){

                                            foreach($modelForm['forms'] as $tierForm) {

                                                if($modelTierActive[$tierIndex] == $tier && $modelForm['forms'][$tierIndex] == $tierForm){

                                                    if(array_key_exists('isActive', $tierForm)) {
                                                        $tier->setIsactive($tierForm['isActive']);
                                                    } else {
                                                        $tier->setIsactive(0);
                                                    }

                                                    $em->persist($model);
                                                    $em->flush();

                                                }
                                            }
                                            $tierIndex++;
                                        }
                                    }

                                    $em->persist($model);
                                    $em->flush();
                                }
                            }
                            $modelindex++;
                        }
                    }

                    $em->persist($product);
                    $em->flush();

                }
            }
            $productIndex++;
        }
    }
}