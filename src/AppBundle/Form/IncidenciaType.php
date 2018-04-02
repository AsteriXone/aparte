<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/11/2017
 * Time: 19:27
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class IncidenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
//            ->add('nombre', TextType::class, array(
//                'label' => 'Nombre',
//                'attr' => array('placeholder' => 'Tu Nombre'),
//                'required' => true,))
//            ->add('email', EmailType::class, array(
//                'label' => 'Email',
//                'attr' => array('placeholder' => 'ejemplo@gmail.com'),
//                'required' => true,))
//            ->add('telefono', NumberType::class, array(
//                'label' => 'Teléfono',
//                'attr' => array('placeholder' => 'Tu teléfono'),
//                'required' => true,))
            ->add('incidencia', TextareaType::class, array(
                'label' => 'Incidencia',
                'attr' => array('placeholder' => 'Escribe aquí tu incidencia'),
                'required' => true,))
            ->add('guardarIncidencia', HiddenType::class, array(
                'attr' => array('id' => 'continuar', 'value' => 'true'),
                ))
        ;
    }
}