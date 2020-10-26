<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MeetingType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $groups = $this->em->getRepository(Group::class)->findAll();
        foreach ($groups as $group) {
            $groupsArray[$group->getName()] = $group;
        }

        $builder
            ->add('name', TextType::class, [
                'label' => 'Naam',
                'attr' => ['class' => 'active'],
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Omschrijving',
                'required' => false
            ])
            ->add('dateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Datum en Tijd',
                'attr' => ['class' => 'datepicker'],
                'required' => true
            ])
            ->add('location', TextType::class, [
                'label' => 'Locatie',
                'attr' => ['class' => 'active'],
                'required' => true
            ])
            ->add('groups', ChoiceType::class, [
                'label' => 'Groepen die aanwezig zijn',
                'choices' => $groupsArray,
                'attr' => ['multiple'=>true],
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Opslaan'
            ])
        ;
    }

}