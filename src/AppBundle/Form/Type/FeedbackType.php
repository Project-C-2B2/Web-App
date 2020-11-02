<?php


namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('name', TextType::class, [
                'label' => 'Naam'
            ])
            ->add('attending', ChoiceType::class, [
                'label' => 'Attendance',
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                    'Maybe' => true,
                ],
                'placeholder' => 'Choice',
                'attr' => ['data-select'=>'true']
                ])
            ->add('funFact');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        //parent::configureOptions($resolver); // TODO: Change the autogenerated stub
//        $resolver->setDefaults([
//            'data_class' => feedback::class //'AppBundle\Entity\Feedback'
//        ]);
    }
}