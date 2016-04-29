<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class WorkingconditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('multiplier', null, array('label' => false))
            ->add('isDefault', 'radio', array('label' => false, 'required'=>false));
                    
                    
                    //CheckboxType::class, array('label' => false));
        
        
            //->add('submit', 'button',array('attr' => array('class'=>'submit','type'=>'input')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Workingcondition'));
    }
}