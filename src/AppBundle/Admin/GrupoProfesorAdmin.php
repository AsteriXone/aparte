<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Profesor;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class GrupoProfesorAdmin extends AbstractAdmin
{
    protected $datagridValues = [

        // display the first page (default = 1)
//        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
//        '_sort_by' => 'updatedAt',
    ];

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
            ->add('profesor')
            ->add('grupo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->add('profesor', null,array('editable' => true, 'sortable'=>true))
            ->add('grupo', null,array('editable' => false, 'sortable'=>true))
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
//            ->add('profesor', ModelType::class, array('class'=>Profesor::class,'label'=>'Profesor', 'btn_add'=>'Crear profesor','btn_delete' => 'Eliminar'))
            ->add('profesor', ModelListType::class, array('class'=>Profesor::class,'label'=>'Profesor', 'btn_add'=>'Crear profesor','btn_delete' => 'Eliminar'))
            ->add('grupo', null, array('label'=> 'Grupo al que pertenece'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('profesor')
            ->add('grupo')
        ;
    }
}
