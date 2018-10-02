<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Muestra;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class GrupoMuestraAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('grupo')
            ->add('muestra')
            ->add('precio')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('muestra.name' ,null, array(
                    'label'=>'Muestra',
                    'base_path' => '%app.path.muestras_images%',
                    'template' => 'image.html.twig',
                )
            )
            ->add('muestra', null, array('label'=>'Nombre'))
            ->add('grupo')
            ->add('precio')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('id')
            ->add('grupo')
            ->add('muestra', ModelListType::class, array('class'=>Muestra::class))
            ->add('precio')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('grupo')
            ->add('muestra.name' ,null, array(
                    'label'=>'Muestra',
                    'base_path' => '%app.path.muestras_images%',
                    'template' => 'image.html.twig',
                )
            )
            ->add('muestra', null, array('label'=>'Nombre'))
            ->add('precio')
        ;
    }
}
