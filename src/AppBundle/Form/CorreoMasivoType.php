<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/11/2017
 * Time: 19:27
 */

namespace AppBundle\Form;

use AppBundle\Entity\Grupo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CorreoMasivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupo', EntityType::class, array(
                'class' => 'AppBundle:Grupo',
                'label' => 'Grupo al que quiere enviar correo:'
            ))
            ->add('asunto', TextType::class,array(
                'label' => 'Asunto',

            ))
            ->add('mensaje', TextareaType::class,array(
                'label' => 'Mensaje',
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enviar',
                'attr' => array('class' => 'btn btn-success')
            ))
        ;
    }
}