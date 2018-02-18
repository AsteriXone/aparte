<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/11/2017
 * Time: 19:27
 */

namespace AppBundle\Form;

use AppBundle\Entity\Muestra;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre',
                'attr' => array('placeholder' => 'Tu Nombre'),
                'required' => true,))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'attr' => array('placeholder' => 'ejemplo@gmail.com'),
                'required' => true,))
            ->add('telefono', NumberType::class, array(
                'label' => 'Teléfono',
                'attr' => array('placeholder' => 'Tu teléfono'),
                'required' => true,))
            ->add('asunto', TextType::class, array(
                'label' => 'Asunto',
                'attr' => array('placeholder' => 'Asunto'),
                'required' => true,))
            ->add('comentario', TextareaType::class, array(
                'label' => 'Comentario',
                'attr' => array('placeholder' => 'Escribe aquí tu comentario'),
                'required' => true,))
        ;
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => Muestra::class,
//        ));
//    }
}