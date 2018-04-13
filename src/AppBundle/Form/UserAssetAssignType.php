<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;


class UserAssetAssignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('assets', CollectionType::class, array(
                    'label' => 'Assets',
                    'entry_type' => EntityType::class,
                    'entry_options' => array(   'class'=>'AppBundle:Asset',
                                                'label'=>false,
                                                'choice_label'=>'formlabel',
                                                'query_builder' => function (EntityRepository $er) {
                                                                        return $er->createQueryBuilder('a')
                                                                            ->orderBy('a.description, a.code', 'ASC');
                                                                    }),
                    'allow_delete' =>true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'attr'=> array('class'=>'asset_collection'),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
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
