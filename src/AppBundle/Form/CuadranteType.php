<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/01/2018
 * Time: 20:49
 */

namespace AppBundle\Form;


use AppBundle\Entity\Cuadrante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CuadranteType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuadrante', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:Cuadrante',

                // use the User.username property as the visible option string
                //'choice_label' => 'cuadrante',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))

            ->add('diaCuadrante', CollectionType::class, array(
                'entry_type' => DiasCuadranteType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'label' => 'Pruebas dias'
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar'
            ))
        ;
    }
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => Cuadrante::class
//        ));
//    }
}