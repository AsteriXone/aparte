<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;

class GrupoAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('universidad')
            ->add('especialidad')
            ->add('anio')
            ->add('codigoGrupo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('__toString', null, array('label'=> 'Grupo', 'sortable'=>true))
//            ->add('especialidad', null, array('editable'=> true))
            ->add('anio', null, array('editable'=> true))
            ->add('codigoGrupo', null, array('editable'=> true))
            ->add('cuadranteGrupo',null, array('label'=>'Cuadrante', 'editable'=> false))
            ->add('isActive',null, array('label'=>'Activo', 'editable'=> true))
            ->add('isCitasActive',null, array('label'=>'Citas', 'editable'=> true))
            ->add('isComprasActive',null, array('label'=>'Compras', 'editable'=> true))
            ->add('isVotosProfe',null, array('label'=>'Votar Profes', 'editable'=> true))
            ->add('isVotosMuestra',null, array('label'=>'Votar Muestras', 'editable'=> true))
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
            ->with('Grupo', ['class' => 'col-md-9'])
            ->add('universidad',ModelListType::class, array('label'=>'Universidad/Colegio'))
            ->add('especialidad', ModelListType::class, array('label'=>'Especialidad/Curso'))
            ->add('anio')
            ->add('codigoGrupo')
            ->end()

            ->with('Gestión', ['class' => 'col-md-3'])
            ->add('isActive',null, array('label'=>'Activo'))
            ->add('isCitasActive',null, array('label'=>'Pedir Citas'))
            ->add('isComprasActive',null, array('label'=>'Hacer Compras'))
            ->add('isVotosProfe',null, array('label'=>'Votar Profes'))
            ->add('isVotosMuestra',null, array('label'=>'Votar Muestras'))

            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Grupo', ['class' => 'col-md-9'])
            ->add('universidad')
            ->add('especialidad')
            ->add('anio')
            ->add('codigoGrupo')
            ->end()

            ->with('Gestión', ['class' => 'col-md-3'])
            ->add('isActive',null, array('label'=>'Activo'))
            ->add('isCitasActive',null, array('label'=>'Pedir Citas'))
            ->add('isComprasActive',null, array('label'=>'Hacer Compras'))
            ->add('isVotosProfe',null, array('label'=>'Votar Profes'))
            ->add('isVotosMuestra',null, array('label'=>'Votar Muestras'))
            ->end()
        ;
    }
}
