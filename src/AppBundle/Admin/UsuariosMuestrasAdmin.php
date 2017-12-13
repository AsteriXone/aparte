<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UsuariosMuestrasAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('usuario')
            ->add('muestra')
            ->add('grupo')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('grupo')
            ->add('usuario')
            ->add('usuario.email')
            ->add('usuario.telefono')
            ->add('muestra')
            ->add('cantidad')
            ->add('precio')
            ->add('estado')
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
            ->add('usuario')
            ->add('muestra')
            ->add('cantidad')
            ->add('precio')
            ->add('grupo')

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('usuario')
            ->add('grupo')
            ->add('muestra')
            ->add('cantidad')
            ->add('precio')
        ;
    }

    public function getExportFields(){
        return array(
            'Grupo' => 'grupo',
            'Usuario'=>'usuario.nombreCompleto',
            'Teléfono' => 'usuario.telefono',
            'Correo' => 'usuario.email',
            'Muestra' => 'muestra.imageName',
            'Cantidad' => 'cantidad',
            'Precio' => 'precio',
        );
    }
}
