<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Form\DataTransformer\GroupsArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Meeting::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Naam Meeting',
                'attr' => ['class' => 'active'],
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Beschrijving',
                'required' => false
            ])
            ->add('dateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Tijd en datum',
                'attr' => ['class' => 'datepicker'],
                'required' => true
            ])
            ->add('location', TextType::class, [
                'label' => 'Waar vind de meeting plaats?',
                'attr' => ['class' => 'active'],
                'required' => true
            ])
            ->add('group', EntityType::class, [
                'class' => Group::class,
                'placeholder' => 'Kies een groep',
                'label' => 'Groep uitnodigen voor meeting',
                'attr' => ['data-select'=>'true'],
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Opslaan'
            ])
        ;
    }

}