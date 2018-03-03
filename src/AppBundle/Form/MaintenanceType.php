<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class MaintenanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('asset', CollectionType::class, array(
                    'entry_type' => EntityType::class,
                    'entry_options' => array('class'=>'AppBundle:Asset', 'choice_label' => 'code'),
                ))
                ->add('vendor', EntityType::class, array('class'=>'AppBundle:Vendor','choice_label'=>'name'))
                ->add('schedule', DateTimeType::class, array('date_widget'=>'single_text', 'time_widget'=>'single_text'))
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
