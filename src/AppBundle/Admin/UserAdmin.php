<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Form\DataTransformer\UserGroupsTransformer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $userGroupTransformer = new UserGroupsTransformer($em);

        $groupsArray = [];
        foreach ($em->getRepository(Group::class)->findAll() as $group) {
            $groupsArray[$group->getName()] = $group;
        }

        $formMapper
            ->add('email', 'email', array(
                'label' => 'Email'
            ))
            ->add('username', 'text', array(
                'label' => 'Username'
            ))
            ->add('lastActivityDate', 'date', array(
                'label' => 'Last Activity Date'
            ))
            ->add('lastCourseFollowed', 'entity', array(
                'class' => Meeting::class,
                'label' => 'Last Course Followed'
            ))
            ->add('groupsInUserAssociation', ChoiceType::class, array(
                'label' => 'Groups',
                'choices' => $groupsArray,
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
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('enabled')
            ->add('lastActivityDate')
            ->add('groupsInUserAssociation')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('lastActivityDate')
            ->add('groupsInUserAssociation')
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('enabled')
            ->add('lastActivityDate')
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
            $groupsInUserAssociation->getGroups()->addGroupsInUserAssociation($groupsInUserAssociation);
        }
    }

}