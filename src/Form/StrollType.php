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
            ->add('title', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Titre'
            ]])
            ->add('startTime', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
            ->add('endTime', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
            ->add('startingPoint', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Adresse point de départ (numéro + voie + code postal + ville)'
            ]])
            ->add('description', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Détails et description de l\'évènement'
            ]])
            ->add('town', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Ville'
            ]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stroll::class,
        ]);
    }
}
