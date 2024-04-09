<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname')  
            ->add('name')
            ->add('ranking', ChoiceType::class, [
                'choices' => [
                    '-' => '',
                    '40' => '40',
                    '30/5' => '30/5',
                    '30/4' => '30/4',
                    '30/3' => '30/3',
                    '30/2' => '30/2',
                    '30/1' => '30/1',
                    '30' => '30',
                    '15/5' => '15/5',
                    '15/4' => '15/4',
                    '15/3' => '15/3',
                    '15/2' => '15/2',
                    '15/1' => '15/1',
                    '15' => '15',
                    '5/6' => '5/6',
                    '4/6' => '4/6',
                    '3/6' => '3/6',
                    '2/6' => '2/6',
                    '1/6' => '1/6',
                    '0' => '0',
                    '-2/6' => '-2/6',
                    '-4/6' => '-4/6',
                    '-15' => '-15',
                    '-30' => '-30',
                ],
            ])
            ->add('club')
            ->add('licence')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de profil',
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
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
