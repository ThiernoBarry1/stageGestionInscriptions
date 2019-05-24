<?php

namespace App\Form;

use App\Entity\DocumentAudioVisuels;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('titre',TextType::class,$this->getConfiguration())
            ->add('realisateur',TextType::class,$this->getConfiguration())
            ->add('genre',ChoiceType::class,$this->getArrayChoice(
                                                                    [
                                                                        'Fiction'=>true,
                                                                        'Documentaire'=>false,
                                                                        'Animation'=>false,
                                                                        'Autre'=>false
                                                                    ],false,false
                                                                )
                )
            ->add('annee',IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'min' => 1950,
                    'max' => 2100,
                    'step' => 1,
                ]
            ])
            ->add('duree',TextType::class,$this->getConfiguration()
                 )
            ->add('lien',TextType::class,$this->getConfiguration()
                )
            ->add('motDePasse',PasswordType::class,$this->getConfiguration()
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DocumentAudioVisuels::class,
        ]);
    }
}
