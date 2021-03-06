<?php

namespace App\Form;

use App\Entity\Dog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nom de l\'animal'
            ]])
            ->add('birthYear', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Année de naissance'
            ]])
            ->add('breed', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Race'
            ]])
            ->add('sex', ChoiceType::class, [
                'choices'  => [
                    'Femelle' => 'Femelle',
                    'Mâle' => 'Mâle'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('bio', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Décrire votre animal'
            ]])
            ->add('picture', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([ 
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => "Ce format n'est pas valide.",
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
