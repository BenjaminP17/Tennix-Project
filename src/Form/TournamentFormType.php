<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TournamentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    '-' => '-',
                    'Tournoi' => 'Tournoi',
                    'Interclub' => 'Interclub',
                ],
            ])
            ->add('saison', ChoiceType::class, [
                'choices' => [
                    '-' => '-',
                    '2023/2024' => '2023/2024',
                ],
            ])
            ->add('echeance')
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
