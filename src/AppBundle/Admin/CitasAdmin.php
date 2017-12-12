<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CitasAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('cuadrante')
            ->add('user')
            ->add('fecha')
            ->add('hora')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('cuadrante',null, array('label'=>'Cuadrante'))
            ->add('user', null, array('label' => 'Usuario'))
            ->add('onlyDate',null, array('label' => 'Fecha'))
            ->add('onlyHour',null, array('label' => 'Hora'))
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
            ->add('cuadrante')
            ->add('user', null, array('label' => 'Usuario'))
            ->add('fecha')
            ->add('hora')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('cuadrante')
            ->add('user', null, array('label' => 'Usuario'))
            ->add('onlyDate')
            ->add('onlyHour')
        ;
    }

    public function getExportFields(){
//        $results = $this->getModelManager()->getExportFields($this->getClass());
        $results[] = 'user';
        $results[] = 'fecha';
        $results[] = 'hora';

        return array(
            'Fecha' => 'onlyDate',
            'Hora' => 'onlyHour',
            'Usuario'=>'user.nombreCompleto',
            'Teléfono' => 'user.telefono',
            'Correo' => 'user.email',
        );
    }
}
