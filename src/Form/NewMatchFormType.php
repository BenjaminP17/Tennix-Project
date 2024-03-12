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
