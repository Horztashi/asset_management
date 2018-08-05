<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class UserAssetAssignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('assets', Select2EntityType::class, [
                    'multiple' => true,
                    'remote_route' => 'api_asset_list',
                    'class' => '\AppBundle\Entity\Asset',
                    'primary_key' => 'id',
                    'text_property' => 'code',
                    'minimum_input_length' => 2,
                    'page_limit' => 10,
                    'allow_clear' => true,
                    'delay' => 250,
                    'cache' => true,
                    'cache_timeout' => 60000, // if 'cache' is true
                    'language' => 'en',
                    'placeholder' => 'Select assigned assets',
                    // 'object_manager' => $objectManager, // inject a custom object / entity manager 
                ]);
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
