<?php
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
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlModuloSistema;

final class MntMenuAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $entity = $this->getSubject();   //obtiene el elemento seleccionado en un objeto
        $id = $entity->getId();
        $formMapper->add('menu', TextType::class)
        ->add('orden', integerType::class)
        ->add('url', TextType::class, array('label' => 'Url', 'required' => FALSE))
        ->add('idModuloSistema', EntityType::class, [
                'class' => CtlModuloSistema::class
            ])
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
        ));
        if ($id) {  // cuando se edite el registro
            if ($entity->getActivo() == TRUE) { // si el registro esta activo
                $formMapper
                        ->add('activo', CheckboxType::class, array('label' => 'Activo', 'required' => FALSE, 'attr' => array('checked' => 'checked')));
            } else { // si el registro esta inactivo
                $formMapper
                        ->add('activo', CheckboxType::class, array('label' => 'Activo', 'required' => FALSE));
            }
        } else { // cuando se crea el registro
                $formMapper
                        ->add('activo', CheckboxType::class, array('label' => 'Activo', 'required' => FALSE, 'attr' => array('checked' => 'checked')));
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('menu');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('menu');
    }

    public function prePersist($menu) {
        //obtener id de usuario logeado
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getEntityManager();
        $userId = $this->getConfigurationPool()
          ->getContainer()->get('security.token_storage')
          ->getToken()->getUser();
        $menu->setIdUsersAdd($userId);
        $menu->setDateAdd(new \DateTime());

        //guardar detalle
        foreach ($menu->getDetalleMenu() as $objDetalle) {
            $submenu = $objDetalle->getSubmenu($menu);
            $url = $objDetalle->getUrl($menu);
            $orden = $objDetalle->getOrden($menu);
            $activo = $objDetalle->getActivo($menu);

            $objDetalle->setSubmenu($submenu);
            $objDetalle->setUrl($url);
            $objDetalle->setOrden($orden);
            $objDetalle->setActivo($activo);
            $objDetalle->setIdMenu($menu);
            $objDetalle->setIdUsersAdd($userId);
            $objDetalle->setDateAdd(new \DateTime());
        }

      }

    public function preUpdate($menu) {
        //obtener id de usuario logeado
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getEntityManager();
        $userId = $this->getConfigurationPool()
          ->getContainer()->get('security.token_storage')
          ->getToken()->getUser();
        $menu->setIdUsersModify($userId);
        $menu->setDateModify(new \DateTime());

        //guardar detalle
        foreach ($menu->getDetalleMenu() as $objDetalle) {
            $submenu = $objDetalle->getSubmenu($menu);
            $url = $objDetalle->getUrl($menu);
            $orden = $objDetalle->getOrden($menu);
            $activo = $objDetalle->getActivo($menu);

            $objDetalle->setSubmenu($submenu);
            $objDetalle->setUrl($url);
            $objDetalle->setOrden($orden);
            $objDetalle->setActivo($activo);
            $objDetalle->setIdMenu($menu);
            //evalua si es detalle nuevo
            if ($objDetalle->getIdUsersAdd($userId) == null){
                $objDetalle->setIdUsersAdd($userId);
                $objDetalle->setDateAdd(new \DateTime());
            }
            $objDetalle->setIdUsersModify($userId);
            $objDetalle->setDateModify(new \DateTime());
        }
      }
}
