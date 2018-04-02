<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class IncidenciaAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)

    {
        $datagridMapper
//            ->add('id')
            ->add('incidencia')
            ->add('grupo_usuario.grupo', null, array('label'=>'Grupo'))
            ->add('grupo_usuario.user', null, array('label'=>'Usuario'))
        ;
    }

    public function __construct($code, $class, $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);

        if (!$this->hasRequest()) {
            $this->datagridValues = array(
                '_page'       => 1,
                '_sort_order' => 'ASC',      // sort direction
                '_sort_by'    => 'grupo_usuario.user.nombreCompleto' // field name
            );
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->add('grupo_usuario.grupo', null, array('label'=>'Grupo', 'sortable' => true, 'sort_field_mapping' => ['fieldName' => 'id'],
                'sort_parent_association_mappings' => [],))
            ->add('grupo_usuario.user.nombreCompleto', null, array('label'=>'Usuario', 'sortable' => true, 'sort_field_mapping' => ['fieldName' => 'id'],
                'sort_parent_association_mappings' => [],))
            ->add('incidencia')
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
            ->add('incidencia')
            ->add('grupo_usuario');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
//            ->add('id')
            ->add('grupo_usuario.grupo', null, array('label'=>'Grupo'))
            ->add('grupo_usuario.user.nombreCompleto', null, array('label'=>'Usuario'))
            ->add('grupo_usuario.user.email', null, array('label'=>'Correo'))
            ->add('grupo_usuario.user.telefono', null, array('label'=>'Teléfono'))
            ->add('incidencia', null, array('label'=>'Descripción'))
        ;
    }

    public function getExportFields()
    {
        return array(
            'Grupo' => 'grupo_usuario.grupo',
            'Usuario'=>'grupo_usuario.user.nombreCompleto',
            'Teléfono' => 'grupo_usuario.user.telefono',
            'Correo' => 'grupo_usuario.user.email',
            'Incidencia' => 'incidencia'
        );
    }
}
