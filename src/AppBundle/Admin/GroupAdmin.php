<?php

namespace AppBundle\Admin;


use AppBundle\Entity\User;
use AppBundle\Form\DataTransformer\GroupsUserTransformer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;


class GroupAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $userGroupTransformer = new GroupsUserTransformer($em);

        $usersArray = [];
        foreach ($em->getRepository(User::class)->findAll() as $user) {
            $usersArray[$user->getUsername()] = $user;
        }

        $formMapper
            ->add('name', 'text', array(
                'label' => 'Name'
            ))
            ->add('description', 'text', array(
                'label' => 'Description'
            ))
            ->add('groupsInUserAssociation', ChoiceType::class, array(
                'label' => 'Users',
                'choices' => $usersArray,
                'multiple' => True,
                'required' => false,
            ))
        ;

        $formMapper->get('groupsInUserAssociation')->addModelTransformer($userGroupTransformer);

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('groupsInUserAssociation')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('groupsInUserAssociation')
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description')
            ->add('groupsInUserAssociation')
        ;
    }

    public function preUpdate($object)
    {
        $this->prePersist($object);
    }

    public function prePersist($object)
    {
        foreach($object->getGroupsInUserAssociation() as $groupsInUserAssociation) {
            $groupsInUserAssociation->getUsers()->addGroupsInUserAssociation($groupsInUserAssociation);
        }
    }

}