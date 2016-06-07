<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelTierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isprocare', 'checkbox', array('label' => false, 'required'=>false))
            ->add('isscr', 'checkbox', array('label' => false, 'required'=>false))
            ->add('iswithtires', 'checkbox', array('label' => false, 'required'=>false))
            ->add('iswithtracks', 'checkbox', array('label' => false, 'required'=>false))
            ->add('fuelusageGallonHour', null, array('label' => false, 'required'=>false))
            ->add('fuelusageLiterHour', null, array('label' => false, 'required'=>false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\ModelTier'));
    }
}