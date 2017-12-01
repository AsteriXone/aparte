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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MuestraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('image')
            ->add('imageFile', FileType::class, array('label' => 'Añadir imagen'))
            ->add('name')
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),
            ))
            // ...
        ;
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => Muestra::class,
//        ));
//    }
}