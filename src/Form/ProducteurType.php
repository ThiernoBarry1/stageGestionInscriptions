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
            ->add('nom',TextType::class)
            ->add('nature',TextType::class)
            ->add('siret',TextType::class)
            ->add('nomGerant',TextType::class)
            ->add('prenomGerant',TextType::class)
            ->add('nomProducteur',TextType::class)
            ->add('prenomProducteur',TextType::class)
            ->add('telephoneFixeProducteur',TextType::class)
            ->add('telephoneMobileProducteur',TextType::class)
            ->add('courrielProducteur',TextType::class)
            ->add('nomPersonneChargee',TextType::class)
            ->add('prenomPersonneChargee',TextType::class)
            ->add('telephoneFixePersonneChargee',TextType::class)
            ->add('telephoneMobilePersonneChargee',TextType::class)
            ->add('courrielPersonneChargee',TextType::class)
            ->add('adresse',TextType::class)
            ->add('codePostal',TextType::class)
            ->add('ville',TextType::class)
            ->add('adresseBureau',TextType::class)
            ->add('codePostaleBureau',TextType::class)
            ->add('villeBureau',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producteur::class,
        ]);
    }
}
