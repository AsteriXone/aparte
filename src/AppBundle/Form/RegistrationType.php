<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 04/11/2017
 * Time: 0:09
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupcode', TextType::class, array(
            'mapped' => false,
            'label' => 'Código Grupo',
            'attr' => array('placeholder' => 'Introduce código'),
            'required' => true,))

            ->add('nombre', TextType::class, array(
                'label' => 'Nombre',
                'attr' => array('placeholder' => 'Tu Nombre'),
                'required' => true,))

            ->add('ape_1', TextType::class, array(
                'label' => '1er. Apellido',
                'attr' => array('placeholder' => '1er. Apellido'),
                'required' => true,))

            ->add('ape_2', TextType::class, array(
                'label' => '2º Apellido',
                'attr' => array('placeholder' => '2º Apellido'),
                'required' => true,))

            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'attr' => array('placeholder' => 'Dirección'),
                'required' => true,))

            ->add('telefono', TextType::class, array(
                'label' => 'Teléfono',
                'attr' => array('placeholder' => 'Teléfono'),
                'required' => true,))

            ->add('titulacion', TextType::class, array(
                'label' => 'Titulación',
                'attr' => array('placeholder' => 'Titulación'),
                'required' => true,))

            ->add('mencion', TextType::class, array(
                'label' => 'Mención',
                'attr' => array('placeholder' => 'Mención'),
                'required' => true,))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix(){
        return 'app_user_registration';
    }

    public function getCodigoGrupo()
    {
        return $this->getBlockPrefix();
    }
}
