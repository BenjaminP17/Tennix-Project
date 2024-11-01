<?php

namespace App\Form;

use \DateTime;
use App\Entity\User;
use App\Entity\Classement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AddNewRankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', ChoiceType::class, [
            'label' => ' ',
            'choices' => [
                'janvier' => new DateTime('2024-01-01'),
                'Février' => new DateTime('2024-02-01'),
                'Mars' => new DateTime('2024-03-01'),
                'Avril' => new DateTime('2024-04-01'),
                'Mai' => new DateTime('2024-05-01'),
                'Juin' => new DateTime('2024-06-01'),
                'Juillet' => new DateTime('2024-07-01'),
                'Août' => new DateTime('2024-08-01'),
                'Septembre' => new DateTime('2024-09-01'),
                'Octobre' => new DateTime('2024-10-01'),
                'Novembre' => new DateTime('2024-11-01'),
                'Décembre' => new DateTime('2024-12-01'),
            ],
            
            
        ])
        ->add('value', ChoiceType::class, [
            'label' => "Classement",
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
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classement::class,
        ]);
    }
}
