<?php

namespace App\Form;

use App\Entity\Stroll;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StrollType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('startTime', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('endTime', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('startingPoint')
            ->add('description')
            ->add('town')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stroll::class,
        ]);
    }
}
