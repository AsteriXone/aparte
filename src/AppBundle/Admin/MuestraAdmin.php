<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Grupo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MuestraAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('imageName')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('imageName', null, array('label' => "Nombre"))
            ->add('imagen' ,null, array(
                'base_path' => '%app.path.muestras_images%',
                'template' => 'vich_uploader_image.html.twig',
                    )
                )
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
            ->add('imageName', null, array('label' => "Nombre"))
            ->add('imagen' ,null, array(
                    'base_path' => '%app.path.muestras_images%',
                    'template' => 'vich_uploader_image.html.twig',
                )
            )
        ;
    }
}
