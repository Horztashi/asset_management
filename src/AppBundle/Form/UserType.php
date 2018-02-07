<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('employeenumber')
  //              ->add('firstname')
    //            ->add('lastname')
      //          ->add('middlename')
        //        ->add('email')
          //      ->add('plainpassword');

        $builder->add('employeenumber', TextType::class,array('label' => 'Employee Number'))
                ->add('firstname', TextType::class,array('label' => 'First Name'))
                ->add('lastname', TextType::class,array('label' => 'Last Name'))
                ->add('middlename', TextType::class,array('label' => 'Middle Name'))
                ->add('email', EmailType::class,array('label' => 'E-mail'))
                ->add('department', EntityType::class,array('class'=>'AppBundle:Department','label' => 'Department', 'choice_label' => 'name'))
                ->add('position', TextType::class,array('label' => 'Position'));
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
        return 'appbundle_user';
    }


}
