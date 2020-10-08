<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Form\DataTransformer\UserGroupsTransformer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MeetingAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                'label' => 'Name'
            ))
            ->add('description', 'text', array(
                'label' => 'Description'
            ))
            ->add('dateTime', 'datetime', array(
                'label' => 'Time of meeting'
            ))
            ->add('location', 'text', array(
                'label' => 'Location'
            ))
//            ->add('attendees', 'entity', array(
//                'label' => 'Attendees',
//                'class' => User::class,
//                'multiple' => true
//            ))
        ;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('dateTime')
            ->add('location')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('dateTime')
            ->add('location')
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description')
            ->add('dateTime')
            ->add('location')
        ;
    }

}