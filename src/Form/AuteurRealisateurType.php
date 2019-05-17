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
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class,[ 
                                             'attr'=>['id'=>'prenom-input']
                                            ]
                 )
            ->add('pseudonyme',TextType::class)
            ->add('adresse',TextType::class)
            ->add('codePostal',TextType::class)
            ->add('ville',TextType::class)
            ->add('telephoneMobile',TextType::class)
            ->add('courriel',TextType::class)
            ->add('typePersonne',ChoiceType::class,$this->getArrayChoice(
                                                                            [
                                                                                'Auteur réalisateur'=>true,
                                                                                'Scénariste'=>false,
                                                                                'Réalisateur'=>false,
                                                                            ]
                                                                        )
                )
            ->add('pourcentageAuteurRealisateur',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AuteurRealisateur::class,
        ]);
    }
}
