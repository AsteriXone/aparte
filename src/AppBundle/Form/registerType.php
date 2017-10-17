<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class registerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Nombre', 'autofocus' => ''),
            ))
            ->add('address', TextType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Dirección'),
            ))
            ->add('telephone', TextType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Teléfono'),
            ))
            ->add('email', EmailType::class, array (
                'label' => false,
                'attr' => array('placeholder' => 'Email'),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array(
                    'label' => false,
                    'attr' => array('placeholder' => 'Contraseña'),
                    ),
                'second_options' => array(
                    'label' => false,
                    'attr' => array('placeholder' => 'Repite contraseña'),
                ),
            ))
            ->add('groupcode', TextType::class, array(
                'mapped' => false,
                'label' => false,
                'attr' => array('placeholder' => 'Introduce código'),
                'required' => true,
            ))
            ->add('Registrar', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-lg btn-primary btn-block'),
            ));
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
           'data-class' => User::class,
        ));
    }
}