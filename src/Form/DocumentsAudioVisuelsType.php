<?php

namespace App\Form;

use App\Entity\DocumentAudioVisuels;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DocumentsAudioVisuelsType extends ConfigurationFildsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $builder
            ->add('titre',TextType::class,[ 'required'=>false])
            ->add('realisateur',TextType::class,[ 'required'=>false])
            ->add('genre',ChoiceType::class,[
                                                'choices'  => [
                                                    'Fiction' => 'fiction',
                                                    'Animation' => 'animation',
                                                    'Documentaire' => 'documentaire',
                                                    'Autre'=>'autre',
                                                ],
                                                
                                            ]
                )
<<<<<<< HEAD
            ->add('annee',IntegerType::class,
                                            [
                                                'required' => false,
                                                'label' => false,
                                                'attr' => [
                                                        'min' => 0,
                                                        'max' => 300,
                                                        'step' => 1,
                                                ]
                                            ]
                )
            ->add('duree',TextType::class,[ 'required'=>false]
=======
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
>>>>>>> d4ff347086523a38e3ed198c045001252d3b9268
                 )
            ->add('lien',TextType::class,[ 'required'=>false]
                )
            ->add('motDePasse',PasswordType::class,[ 'required'=>false]
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
