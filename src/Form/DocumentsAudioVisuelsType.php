<?php

namespace App\Form;

use App\Entity\DocumentAudioVisuels;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DocumentsAudioVisuelsType extends ConfigurationFildsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $builder
            ->add('titre',TextType::class)
            ->add('realisateur',TextType::class)
            ->add('genre',ChoiceType::class,$this->getArrayChoice(
                                                                    [
                                                                        'Fiction'=>true,
                                                                        'Documentaire'=>false,
                                                                        'Animation'=>false,
                                                                        'Autre'=>false
                                                                    ],false,false
                                                                )
                )
            ->add('annee',ChoiceType::class,
                ['choices'  => 
                   $this->getArrayDuration(1950,2100),
                ])
            ->add('duree',TextType::class)
            ->add('lien',TextType::class)
            ->add('motDePasse',PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DocumentAudioVisuels::class,
        ]);
    }
}
