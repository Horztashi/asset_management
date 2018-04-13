<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class AssetUserAssignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('users', CollectionType::class, array(
                    'label' => 'Custodians',
                    'entry_type' => EntityType::class,
                    'entry_options' => array(   'class'=>'AppBundle:User',
                                                'label'=>false,
                                                'choice_label'=>'formlabel',
                                                'query_builder' => function (EntityRepository $er) {
                                                                        return $er->createQueryBuilder('u')
                                                                            ->where('u.enabled = 1')
                                                                            ->orderBy('u.lastname,u.firstname,u.middlename', 'ASC');
                                                                    }),                    
                    'allow_delete' =>true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'attr'=> array('class'=>'user_collection'),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Asset'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_assetassign';
    }


}
