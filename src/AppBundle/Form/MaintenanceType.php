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
                ->add('assets', CollectionType::class, array(
                    'label' => false,
                    'entry_type' => EntityType::class,
                    'entry_options' => array(   'class'=>'AppBundle:Asset',
                                                'choice_label'=>'code',
                                                'attr'=> array(
                                                                'class'=>'')),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'prototype_data' => 'New Tag Placeholder',
                    'by_reference' => true,
                ))
                /*->add('assets', CollectionType::class, array(
                        'entry_type' => TextType::class ,
                        'allow_add' => true,
                        'entry_options'=> array(
                            'attr' =>array('class' => 'email-box')
                        )))*/
                ->add('vendor', EntityType::class, array('class'=>'AppBundle:Vendor','choice_label'=>'name'))
                ->add('schedule', DateType::class, array('widget'=>'single_text'))
                ->add('reason');
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
