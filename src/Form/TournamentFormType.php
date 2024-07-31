<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class TournamentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd MMMM yyyy',
                'data' => new \DateTime(),
                'constraints' => [
                    new Callback(function ($date, ExecutionContextInterface $context) {
                        $form = $context->getObject()->getParent();
                        $echeance = $form->get('echeance')->getData();
        
                        if ($echeance && $date > $echeance) {
                            $context->buildViolation('La date doit être antérieure à la date d\'échéance.')
                                ->atPath('date')
                                ->addViolation();
                        }
                    }),
                ],
            ])
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
            ->add('echeance', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd MMMM yyyy',
                'data' => new \DateTime()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
