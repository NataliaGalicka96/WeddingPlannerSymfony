<?php

namespace App\Form;

use App\Entity\Guest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Imię i nazwisko',
                'attr' => [
                    'placeholder' => "Imię i nazwisko"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('is_confirmed', CheckboxType::class,[
                'label' => 'Potwierdzona obecność',
                'required' => false
            ])
            ->add('is_accommodation', CheckboxType::class,[
                'label' => 'Nocleg',
                'required' => false
            ])
            ->add('transport', CheckboxType::class,[
                'label' => 'Transport',
                'required' => false
            ])
            ->add('is_adult', CheckboxType::class,[
                'label' => 'Osoba dorosła',
                'required' => false
            ])
            ->add('is_child_under_3_years', CheckboxType::class,[
                'label' => 'Dziecko poniżej 3 roku życia',
                'required' => false
            ])
            ->add('is_child_between_3_12_years', CheckboxType::class,[
                'label' => 'Dziecko 3-12 lat',
                'required' => false
            ])
            ->add('special_diet', CheckboxType::class,[
                'label' => 'Specjalna dieta',
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guest::class,
        ]);
    }
}
