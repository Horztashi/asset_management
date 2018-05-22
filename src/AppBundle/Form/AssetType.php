<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code', TextType::class)
                ->add('description', TextType::class)
                ->add('iscritical', CheckboxType::class, array('label'=>'Is this a critical asset?','required' => false))
                ->add('isPersonal', CheckboxType::class, array('label'=>'Is this a Personal asset?','required' => false))
                ->add('location', EntityType::class, array('class'=>'AppBundle:Location','choice_label'=>'name'))
                ->add('status', EntityType::class, array('class'=>'AppBundle:Status','choice_label'=>'name'))
                ->add('category', EntityType::class, array('class'=>'AppBundle:Category','choice_label'=>'name'))
                ->add('ponumber', TextType::class)
                ->add('vendor', EntityType::class, array('class'=>'AppBundle:Vendor','choice_label'=>'name'))
                ->add('model', EntityType::class, array('class'=>'AppBundle:Model','choice_label'=>'name'))
                ->add('price', MoneyType::class, array('currency' => 'PHP'))
                ->add('manufacturerserial', TextType::class)
                ->add('warrantystart', DateType::class, array('widget'=>'single_text'))
                ->add('warrantyend', DateType::class, array('widget'=>'single_text'))
                ->add('purchasedate', DateType::class, array('widget'=>'single_text'))
                ->add('servicedate', DateType::class, array('widget'=>'single_text'))
                ;
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
        return 'appbundle_asset';
    }


}
