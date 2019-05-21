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
            ->add('nom',TextType::class,$this->getConfiguration()
                                        
                )
            ->add('prenom',TextType::class,$this->getConfiguration()
                                           
                 )
            ->add('pseudonyme',TextType::class,$this->getConfiguration()
                )
            ->add('adresse',TextType::class,$this->getConfiguration()
                )
            ->add('codePostal',TextType::class,$this->getConfiguration()
                )
            ->add('ville',TextType::class,$this->getConfiguration()
                )
            ->add('telephoneMobile',TextType::class,$this->getConfiguration()
                )
            ->add('courriel',TextType::class,$this->getConfiguration()
                )
            ->add('typePersonne',ChoiceType::class,$this->getArrayChoice(
                                                                            [
                                                                                'Auteur réalisateur'=>true,
                                                                                'Scénariste'=>false,
                                                                                'Réalisateur'=>false,
                                                                            ],false,true
                                                                        )
                )
            ->add('pourcentageAuteurRealisateur',TextType::class, $this->getConfiguration()
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
