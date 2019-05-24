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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producteur::class,
        ]);
    }
}
