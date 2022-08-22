<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Nazwa użytkownika",
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Proszę podać nazwę użytkownika.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Twoja nazwa użytkownika powinna składać się z przynajmniej {{ limit }} znaków.',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                        'maxMessage' => 'Twoja nazwa użytkownika powinna składać się z maksymalnie {{ limit }} znaków.',
                    ]),
                    
                ],

            ])
            ->add('email', EmailType::class, [
                'label' => 'Adres e-mail',
                
            ])

            ->add('plainPassword', PasswordType::class, [
                'label' => "Hasło",
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Proszę podać hasło.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Twoje hasło powinno składać się z conajmniej {{ limit }} znaków.',
                        // max length allowed by Symfony for security reasons
                        'max' => 30,
                        'maxMessage' => 'Twoje hasło powinno składać się z maksymalnie {{ limit }} znaków.',

                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
