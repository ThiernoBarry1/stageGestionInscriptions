<?php

namespace App\Form;

use App\Entity\Projet;
use App\Form\ProducteurType;
use App\Entity\AuteurRealisateur;
use App\Form\AuteurRealisateurType;
use App\Entity\DocumentAudioVisuels;
use App\Form\ConfigurationFildsType;
use App\Form\DocumentsAudioVisuelsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistrationType extends ConfigurationFildsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,$this->getConfiguration())
            ->add('duree',ChoiceType::class,
                                         [
                                            'choices'=>
                                            [
                                              $this->getArrayDuration(1,300)
                                            ],
                                         ]
                  )
            ->add('typeFilm',ChoiceType::class,$this->getArrayChoice(
                                         ['Unitaire'=>true,
                                           'Serie'=>false
                                         ])
                )
            ->add('dureeEpisode',ChoiceType::class,
                                                   [
                                                     'choices'=>
                                                     [
                                                       $this->getArrayDuration(1,300)
                                                     ],
                                                   ]
                  )
            ->add('formatTournage',TextType::class,$this->getConfiguration())
            ->add('formatDefinitif',TextType::class,$this->getConfiguration())
            ->add('genre',ChoiceType::class,
                $this->getArrayChoice(
                                       [
                                        'Fiction' => true,
                                        'Animation' => false,
                                        'Documentaire' => false,
                                        'Autre'=>false,
                                       ]
                                      )
                   )
              ->add('typeOeuvre',TextType::class,$this->getConfiguration())
             ->add('genrePrecisionAutre',TextType::class,$this->getConfiguration())
            ->add('synopsis',TextareaType::class,$this->getConfiguration())
            ->add('adaptationOeuvre',ChoiceType::class,
                        $this->getArrayChoice(
                                               ['Oui' => true, 
                                                'Non' => false,
                                               ]
                                             )
                  )
            ->add('adaptationOeuvreToa',TextType::class,$this->getConfiguration())
            ->add('adaptationOeuvreDacp',TextType::class,$this->getConfiguration())
            ->add('adaptationOeuvreDfc',DateType::class,
                                                        [
                                                          'widget' => 'single_text',
                                                          'attr' => ['class' => 'w-75']
                                                        ]
                  )
            ->add('deposant',ChoiceType::class, $this->getArrayChoice(
                                                                [ 
                                                                  'Le producteur' => true, 
                                                                  'L\'auteur/le réalisateur ' => false,
                                                                ]
                                                                )
                )
               ->add('producteurs',CollectionType::class,
                                                           [
                                                            'entry_type'=>ProducteurType::class
                                                           ]
                    )
              ->add('auteurRealisateurs',CollectionType::class,
                                                                [
                                                                  'entry_type'=>AuteurRealisateurType::class,
                                                                  'allow_add'=>true,
                                                                  'allow_delete'=>true,
                                                                ]
                    )
                 ->add('documentAudioVisuels',CollectionType::class,
                                                                    [
                                                                      'entry_type'=>DocumentsAudioVisuelsType::class,
                                                                      'allow_add'=>true,
                                                                      'allow_delete'=>true,
                                                                    ]
                      )
               ->add('typeAideLm',ChoiceType::class,$this->getArrayChoice(
                                                                          [
                                                                            'Écriture' => true,
                                                                            'Réécriture' => false,
                                                                          ]
                                                                        )
                    )
            ->add('typeAideDoc',ChoiceType::class, $this->getArrayChoice(
                                                                          [
                                                                            'Écriture' => true,
                                                                            'Développement' => false,
                                                                          ]
                                                                        )
                  )
            ->add('mtBudget',TextType::class,$this->getConfiguration())
            ->add('liensEligibilite',ChoiceType::class,$this->getArrayChoice(
                                                                              ['Un auteur réalisateur domicilié en région Normandie'=>true,
                                                                               'Une société de production disposant d’un établissement stable en région Normandie'=>false,
                                                                               'Un projet entretenant un lien culturel avec la région Normandie'=>false,
                                                                               'Un auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années '=>false,
                                                                              'Un projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années'=>false,
                                                                             ],true
                                                                            )
                  )
            ->add('datePreparation',TextType::class,$this->getConfiguration())
            ->add('dateTournage',TextType::class,$this->getConfiguration())
            ->add('dateDiffusion',TextType::class,$this->getConfiguration())
            ->add('castingEnvisage',TextType::class,$this->getConfiguration())
            ->add('listeLieuxTournage',TextareaType::class,$this->getConfiguration())
            ->add('nombreJoursTournage',TextType::class,$this->getConfiguration())
            ->add('nombreJoursTotal',TextType::class,$this->getConfiguration())
            ->add('droitArtistiqueTotalHt',TextType::class,$this->getConfiguration())
            ->add('droitArtistiqueTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('personnelTotalHt',TextType::class,$this->getConfiguration())
            ->add('personnelTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('interpretationTotalHt',TextType::class,$this->getConfiguration())
            ->add('interpretationTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('totalChargeSocialesTotalHt',TextType::class,$this->getConfiguration())
            ->add('totalChargeSocialesTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('decoEtCostumesTotalHt',TextType::class,$this->getConfiguration())
            ->add('decoEtCostumesTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('transportTotalHt',TextType::class,$this->getConfiguration())
            ->add('transportTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('moyenTechniqueTournageTotalHt',TextType::class,$this->getConfiguration())
            ->add('postProdTotalHt',TextType::class,$this->getConfiguration())
            ->add('moyenTechniqueTournageTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('postProdTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('assuranceEtFraisTotalHt',TextType::class,$this->getConfiguration())
            ->add('assuranceEtFraisTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('fraisFinanciersTotalHt',TextType::class,$this->getConfiguration())
            ->add('fraisFinanciersTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('fraisGenerauxTotalHt',TextType::class,$this->getConfiguration())
            ->add('fraisGenerauxTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('imprevusTotalHt',TextType::class,$this->getConfiguration())
            ->add('imprevusTotalHtNormandie',TextType::class,$this->getConfiguration())
            ->add('totalGeneralTotalHt',TextType::class,['disabled'=>true,'required'=>false])
            ->add('totalGeneralTotalHtNormandie',TextType::class,['disabled'=>true,'required'=>false])
            ->add('financementAcquis',ChoiceType::class,
                     $this->getArrayChoice(
                                             [
                                              'Oui'=>true,
                                              'Non'=>false
                                              ]
                                           )
                  )
            ->add('financementAcquisPrecision',TextType::class,$this->getConfiguration())
            ->add('montantSollicite',TextType::class,$this->getConfiguration())
            ->add('depotProjetCollectivite',ChoiceType::class,
                   $this->getArrayChoice(
                                          [
                                            'Oui'=>true,
                                            'Non'=>false
                                          ]
                                       )
                 )
            ->add('depotProjetCollectivitePrecision',TextType::class,$this->getConfiguration())
            ->add('projetDejaPresenteFondsAide',ChoiceType::class,$this->getArrayChoice(
                                                                                          [
                                                                                            'Oui'=>true,
                                                                                            'Non'=>false
                                                                                          ]
                                                                                       )
                 )
            ->add('projetDejaPresenteFondsAideDate',TextType::class,$this->getConfiguration())
            ->add('projetDejaPresenteFondsAideTypeAide',TextType::class,$this->getConfiguration())
            ->add('file',FileType::class,$this->getConfiguration())  
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
