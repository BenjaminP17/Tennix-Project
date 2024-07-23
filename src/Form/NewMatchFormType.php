<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Rencontre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('competition', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez le nom de la compétition',
                    ]),
                ],
            ])
            ->add('Adversaire', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez le nom de l\'adversaire',
                    ]),
                ],
            ])
            ->add('classement', ChoiceType::class, [
                'choices' => [
                    '-' => '',
                    'NC'=> 'NC',
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
                'constraints' => [
                    new NotBlank(['message' => 'Renseignez le classement'
                ]),
    ],
            ])
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    '-' => '-',
                    'Simple' => 'Simple',
                    'Double' => 'Double',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide.',
        ]),
    ],
            ])
            ->add('saison', ChoiceType::class, [
                'choices' => [
                    '-' => '-',
                    '2023/2024' => '2023/2024',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Sélectionnez une saison',
        ]),
    ],
            ])
            ->add('resultat', ChoiceType::class, [
                'choices' => [
                    'Victoire' => 'Victoire',
                    'Défaite' => 'Défaite',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Renseignez le résultat',
        ]),
    ],
            ])
            ->add('Score', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez le score',
                    ]),
                ],
            ])
            // ->add('date')
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd MMMM yyyy',
                'data' => new \DateTime()
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rencontre::class,
        ]);
    }
}
