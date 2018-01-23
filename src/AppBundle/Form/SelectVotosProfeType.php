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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectVotosProfeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupo', EntityType::class, array(
                'class' => 'AppBundle:Grupo',
                'label' => 'Grupo sobre el que quiere realizar la consulta:'
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Consultar',
                'attr' => array('class' => 'btn btn-success')
            ))
        ;
    }
}