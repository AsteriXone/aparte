<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageOrlaAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('grupo', null, array('label' => 'Grupo'))
            ->add('imageName',null, array('label' => 'Nombre Imagen'))
            ->add('updatedAt',null, array('label' => 'Fecha'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->add('grupo', null, array('label' => 'Grupo'))
            ->add('imagen' ,null, array(
                    'label' => 'Imagen',
                    'base_path' => '%app.path.orla_images%',
                    'template' => 'orla_image.html.twig',
                )
            )
            ->add('imageName',null, array('label' => 'Nombre Imagen'))
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
            ->add('grupo', null, array('label' => 'Grupo'))
            ->add('imageName',null, array('label' => 'Nombre Imagen'))
            ->add('imageFile', FileType::class, array('label' => 'Subir imagen'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('grupo', null, array('label' => 'Grupo'))
            ->add('imageName',null, array('label' => 'Nombre Imagen'))
            ->add('updatedAt', null, array('label' => 'Fecha'))
        ;
    }
}
