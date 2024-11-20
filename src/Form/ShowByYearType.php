<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Rencontre;
use App\Repository\RencontreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ShowByYearType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = range(date('Y'), 2010);

        $builder
            ->add('year', ChoiceType::class, [
                'choices' => array_combine($years, $years),
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
