<?php

namespace App\Form;

use App\Entity\Producteur;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProducteurType extends ConfigurationFildsType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[ 'required'=>false]
                )
            ->add('nature',TextType::class,[ 'required'=>false]                          
                )
            ->add('siret',TextType::class,[ 'required'=>false]
                )
            ->add('nomGerant',TextType::class,[ 'required'=>false]
                )
            ->add('prenomGerant',TextType::class,[ 'required'=>false]
                )
            ->add('nomProducteur',TextType::class,[ 'required'=>false]
                )
            ->add('prenomProducteur',TextType::class,[ 'required'=>false]
                )
            ->add('telephoneFixeProducteur',TextType::class,[ 'required'=>false]
                )
            ->add('telephoneMobileProducteur',TextType::class,[ 'required'=>false]
                )
            ->add('courrielProducteur',TextType::class,[ 'required'=>false]
                )
            ->add('nomPersonneChargee',TextType::class,[ 'required'=>false]
                )
            ->add('prenomPersonneChargee',TextType::class,[ 'required'=>false]
                )
            ->add('telephoneFixePersonneChargee',TextType::class,[ 'required'=>false]
                )
            ->add('telephoneMobilePersonneChargee',TextType::class,[ 'required'=>false]
                )
            ->add('courrielPersonneChargee',TextType::class,[ 'required'=>false]
                )
            ->add('adresse',TextType::class,[ 'required'=>false]
                )
            ->add('codePostal',TextType::class,[ 'required'=>false]
                )
            ->add('ville',TextType::class,[ 'required'=>false]
                )
            ->add('adresseBureau',TextType::class,[ 'required'=>false]
                )
            ->add('codePostaleBureau',TextType::class,[ 'required'=>false]
                )
            ->add('villeBureau',TextType::class,[ 'required'=>false]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producteur::class,
        ]);
    }
}
