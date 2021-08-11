<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Adresse mail'
            ]])
            ->add('nickname', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Pseudo'
            ]])
            ->add('firstName', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Prénom'
            ]])
            ->add('lastName', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nom'
            ]])
            ->add('town', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Ville'
            ]])
            ->add('bio', null, ['attr' => [
                'class' => 'form-control',
                'placeholder' => 'Présentez-vous en quelques lignes'
            ]])
            ->add('picture', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Choisir une photo au format jpeg ou png',
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
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'insérer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire mininum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
