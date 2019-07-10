<?php

namespace App\Form;

use App\Entity\ProjetPresente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProjetPresenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[ 'required'=>false])
            ->add('auteurrealisateur',TextType::class,[ 'required'=>false])
            ->add('genre',ChoiceType::class,[
                                                'choices'  => [
                                                    'Fiction' => 'fiction',
                                                    'Animation' => 'animation',
                                                    'Documentaire' => 'documentaire',
                                                    'Autre'=>'autre',
                                                    
                                                ],
                                                'expanded' => true,
                                                'required' => false,
                                                'multiple' => false,
                                                'data'=>'fiction'
                                            ]
                )
            ->add('dureeEnvisagee',TextType::class,
                                            [
                                                'required' => false,
                                                'label' => false,
                                                'attr' => [
                                                        'min' => 1,
                                                        'max' => 300,
                                                        'step' => 1,
                                                ],
                                            ]
                )
            ->add('precisionAutre',TextType::class,['required'=>false])
            ->add('coutPrevisionnel',TextType::class,[ 'required'=>false]
                 )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjetPresente::class,
        ]);
    }
}
