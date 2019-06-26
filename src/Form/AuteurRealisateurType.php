<?php

namespace App\Form;

use App\Entity\AuteurRealisateur;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AuteurRealisateurType extends ConfigurationFildsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,['required'=>false]
                 )
            ->add('prenom',TextType::class,['required'=>false]
                 )
            ->add('pseudonyme',TextType::class,['required'=>false]
                 )
            ->add('adresse',TextType::class,['required'=>false]
                 )
            ->add('codePostal',TextType::class,['required'=>false]
                 )
            ->add('ville',TextType::class,['required'=>false]
                )
            ->add('telephoneMobile',TextType::class,['required'=>false]
                )
            ->add('courriel',TextType::class,['required'=>false]
                )
            ->add('typePersonne',ChoiceType::class,
                                            [
                                                'choices'  => [
                                                    'Auteur réalisateur'=>'Auteur réalisateur',
                                                    'Auteur'=>'Scénariste',
                                                    'Réalisateur'=>'Réalisateur'
                                                ],
                                                'expanded' => true,
                                                'required' => true,
                                                'multiple' => false,
                                                'data'=>'Auteur réalisateur'
                                            ]
                )
            ->add('pourcentageAuteurRealisateur',TextType::class, ['required'=>false]
                 )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AuteurRealisateur::class,
        ]);
    }
}
