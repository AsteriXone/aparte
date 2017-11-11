<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('email')
            ->add('address')
            ->add('telephone')
            ->add('isActive')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
//            ->add('username')
//            ->add('roles')
//            ->add('password')
            ->add('email')
            ->add('address')
            ->add('telephone')
            ->add('isActive')
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
            ->add('username', null, array(
                'label' => 'Nombre'
            ))
//            ->add('roles')
//            ->add('plainPassword', null, array(
//                'label' => 'Contraseña'
//            ))
            ->add('password')
            ->add('email', null, array(
                'label' => 'Email'
            ))
            ->add('address', null, array(
                'label' => 'Dirección'
            ))
            ->add('telephone', null, array(
                'label' => 'Teléfono'
            ))
//            ->add('isActive')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('email')
            ->add('address')
            ->add('telephone')
            ->add('isActive')
        ;
    }
}
