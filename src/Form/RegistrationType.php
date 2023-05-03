<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Username', TextType::class,[
                'attr' =>[
                    'class'=>'form-control '
                ],
                'label' => 'Username',
                'label_attr' => [
                    'class' =>'form-label mt-4'
                ],
                'constraints' =>[
                    new Assert\NotBlank(),
                ]
            ])
            ->add('email',  EmailType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' =>'form-label  mt-4 '
                ],

                'constraints' =>[
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ] )
            ->add('plainPassword', RepeatedType::class,[
                'type' =>PasswordType::class,
                'first_options' =>[
                    'label' => 'Password',

                    'label_attr' => [
                        'class' =>'form-label  mt-4'
                        ],
                    'attr' =>[
                        'class'=>'form-control'
                    ],

                ],
                'second_options' =>[
                    'label' => 'Confirm password',

                    'label_attr' => [
                        'class' =>'form-label  mt-4'
                        ],
                    'attr' =>[
                        'class'=>'form-control'
                    ],

                ],
                'invalid_message' =>'password error'
            ])
            ->add('submit', SubmitType::class, [
                'attr'=>[
                    'class' => 'btn btn-dark mt-4'
                ]
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
