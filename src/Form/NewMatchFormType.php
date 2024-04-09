<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Rencontre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('competition')
            ->add('Adversaire')
            ->add('classement', ChoiceType::class, [
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
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    '-' => '-',
                    'Simple' => 'Simple',
                    'Double' => 'Double',
                ],
            ])
            ->add('resultat', ChoiceType::class, [
                'choices' => [
                    'Victoire' => 'Victoire',
                    'Défaite' => 'Défaite',
                ],
            ])
            ->add('Score')
            ->add('date')
//             ->add('user', EntityType::class, [
//                 'class' => User::class,
// 'choice_label' => 'id',
//             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rencontre::class,
        ]);
    }
}
