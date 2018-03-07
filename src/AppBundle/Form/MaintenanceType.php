<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class MaintenanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('vendor', EntityType::class, array('class'=>'AppBundle:Vendor','choice_label'=>'name'))
                ->add('schedule', DateType::class, array('widget'=>'single_text'))
                ->add('reason')
                ->add('assets', CollectionType::class, array(
                    'label' => 'Assets',
                    'entry_type' => EntityType::class,
                    'entry_options' => array(   'class'=>'AppBundle:Asset',
                                                'label'=>false,
                                                'choice_label'=>'code',
                                                ),
                    'allow_delete' =>true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => true,
                    'attr'=> array('class'=>'asset-collection'),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Maintenance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_maintenance';
    }


}
