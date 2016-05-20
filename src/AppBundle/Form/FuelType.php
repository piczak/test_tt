<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fuelPriceGallon', TextType::class, array('label' => false))
            ->add('fuelPriceLiter', TextType::class, array('label' => false))
            ->add('defPriceGallon', TextType::class, array('label' => false))
            ->add('defPriceLiter', TextType::class, array('label' => false));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Fuel'));
    }
}