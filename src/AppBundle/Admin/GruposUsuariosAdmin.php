<?php

namespace AppBundle\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GruposUsuariosAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('grupo')
            ->add('user', null, array ('label'=>'Usuario'))
            ->add('user.telefono', null, array ('label'=>'Teléfono'))
            ->add('user.email', null, array ('label'=>'Correo'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->add('grupo',null, array('editable'=>true))
            ->add('user', null, array ('label'=>'Usuario'))
            ->add('user.telefono', null, array ('label'=>'Teléfono'))
            ->add('user.email', null, array ('label'=>'Correo'))
            ->add('user.onlyDate',null, array('label' => 'Fecha Registro'))
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
            //->add('id')
            ->add('grupo')
            ->add('user')
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
            ->add('user', null, array ('label'=>'Usuario'))
            ->add('user.telefono', null, array ('label'=>'Teléfono'))
            ->add('user.email', null, array ('label'=>'Correo'))
            ->add('user.onlyDate',null, array('label' => 'Fecha Registro'))
        ;
    }

    public function getExportFields()
    {
        return array(
            'Grupo' => 'grupo',
            'Usuario'=>'user.nombreCompleto',
            'Teléfono' => 'user.telefono',
            'Correo' => 'user.email',
            'Fecha Registro' => 'user.onlyDate'
        );
    }
}
