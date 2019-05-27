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
<<<<<<< HEAD
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
=======
            ->add('nom',TextType::class,[
                'required' => false,
            ])
            ->add('nature',TextType::class,$this->getConfiguration())
            ->add('siret',TextType::class,$this->getConfiguration())
            ->add('nomGerant',TextType::class,$this->getConfiguration())
            ->add('prenomGerant',TextType::class,$this->getConfiguration())
            ->add('nomProducteur',TextType::class,$this->getConfiguration())
            ->add('prenomProducteur',TextType::class,$this->getConfiguration())
            ->add('telephoneFixeProducteur',TextType::class,$this->getConfiguration())
            ->add('telephoneMobileProducteur',TextType::class,$this->getConfiguration())
            ->add('courrielProducteur',TextType::class,$this->getConfiguration())
            ->add('nomPersonneChargee',TextType::class,$this->getConfiguration())
            ->add('prenomPersonneChargee',TextType::class,$this->getConfiguration())
            ->add('telephoneFixePersonneChargee',TextType::class,$this->getConfiguration())
            ->add('telephoneMobilePersonneChargee',TextType::class,$this->getConfiguration())
            ->add('courrielPersonneChargee',TextType::class,$this->getConfiguration())
            ->add('adresse',TextType::class,$this->getConfiguration())
            ->add('codePostal',TextType::class,$this->getConfiguration())
            ->add('ville',TextType::class,$this->getConfiguration())
            ->add('adresseBureau',TextType::class,$this->getConfiguration())
            ->add('codePostaleBureau',TextType::class,$this->getConfiguration())
            ->add('villeBureau',TextType::class,$this->getConfiguration())
>>>>>>> d4ff347086523a38e3ed198c045001252d3b9268
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producteur::class,
        ]);
    }
}
