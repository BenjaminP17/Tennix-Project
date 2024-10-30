<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Classement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddNewRankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            // ->add('ranking')
            ->add('value', ChoiceType::class, [
                'choices' => [
                    '-' => '',
                    '40' => '1',
                    '30/5' => '2',
                    '30/4' => '3',
                    '30/3' => '4',
                    '30/2' => '5',
                    '30/1' => '6',
                    '30' => '7',
                    '15/5' => '8',
                    '15/4' => '9',
                    '15/3' => '10',
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
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classement::class,
        ]);
    }
}
