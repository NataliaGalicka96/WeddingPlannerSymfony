<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nazwa kontaktu',
                'attr' => [
                    'placeholder' => "Nazwa kontaktu"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'E-mail'
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('phoneNumber', IntegerType::class,[
                'label' => 'Numer telefonu',
                'attr' => [
                    'placeholder' => "Numer telefonu"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('street', TextType::class,[
                'label' => 'Nazwa ulicy',
                'attr' => [
                    'placeholder' => "Nazwa ulicy"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('homeNumber', IntegerType::class,[
                'label' => 'Numer domu',
                'attr' => [
                    'placeholder' => "Numer domu"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                    
                ]
            ])
            ->add('city', TextType::class,[
                'label' => 'Miasto',
                'attr' => [
                    'placeholder' => "Miasto"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('postalcode', TextType::class,[
                'label' => 'Kod pocztowy',
                'attr' => [
                    'placeholder' => "Kod pocztowy"
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
