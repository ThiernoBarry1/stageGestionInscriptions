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
<<<<<<< HEAD
            ->add('nom',TextType::class,['required'=>false]
=======
            ->add('nom',TextType::class, [
                    'required' => false,
                ])
            ->add('prenom',TextType::class,$this->getConfiguration()
                                           
>>>>>>> d4ff347086523a38e3ed198c045001252d3b9268
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
                                                    'Scénariste'=>'Scénariste',
                                                    'Réalisateur'=>'Réalisateur'
                                                ],
                                                'expanded' => true,
                                                'required' => true,
                                                'multiple' => false,
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
