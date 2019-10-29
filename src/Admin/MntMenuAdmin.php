<?php
// src/Admin/MenuAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\CoreBundle\Form\Type\CollectionType as sonata_type_collection;

final class MntMenuAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('menu', TextType::class)
        ->add('orden', integerType::class)
        ->add('activo', CheckboxType::class)
        ->add('url', TextType::class)
        ->add('idModuloSistema', IntegerType::class)
        ->end()
        ->add('detalleMenu', sonata_type_collection::class, array(
            'type_options' => array(
                // Prevents the "Delete" option from being displayed
                'delete' => false,
                'delete_options' => array(
                    // You may otherwise choose to put the field but hide it
                    'type'         => 'hidden',
                    // In that case, you need to fill in the options as well
                    'type_options' => array(
                        'mapped'   => false,
                        'required' => false,
                    )
                )
            )
        ), array(
            'edit' => 'inline',
            'inline' => 'table',
            'sortable' => 'position',
        ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('menu');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('menu');
    }
}
