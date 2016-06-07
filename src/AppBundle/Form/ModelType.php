<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', null, array('label' => false, 'required'=>false))
            ->add('isActive', 'checkbox', array('label' => false, 'required'=>false))
            //->add('id', null, array('label' => false, 'required'=>false))
            ->add('forms', CollectionType::class, array('entry_type' => TierActiveType::class));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Model'));
    }
}