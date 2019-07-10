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
use phpDocumentor\Reflection\Types\Integer;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistrationType extends ConfigurationFildsType
{ 
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[ 'required'=>false])
            ->add('duree',IntegerType::class,
                                              [
                                               'required' => false,
                                               'attr' => [
                                                          'min' => 1,
                                                          'max' => 300,
                                                          'step' => 1,
                                               ],
                                              ]
                   )
            ->add('typeFilm',ChoiceType::class,
                                         [
                                          'choices'  => [
                                              'Unitaire'=>'unitaire',
                                              'Série'=>'serie'
                                          ],
                                          'expanded' => true,
                                          'required' => false,
                                          'multiple' => false,
                                          
                                        ]
                )
            ->add('nombreEpisode',IntegerType::class,
                                              [
                                               'required' => false,
                                               'attr' => [
                                                          'min' => 1,
                                                          'max' => 300,
                                                          'step' => 1,
                                               ],
                                               
                                              ]
                   )
            ->add('dureeEpisode',IntegerType::class,
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
            ->add('formatTournage',TextType::class,[ 'required'=>false])
            ->add('formatDefinitif',TextType::class,[ 'required'=>false])
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
                                              
                                            ]
                  )
            ->add('typeOeuvre',TextType::class,[ 'required'=>false])
            ->add('genrePrecisionAutre',TextType::class,[ 'required'=>false])
            ->add('synopsis',TextareaType::class,[ 'required'=>false])
            ->add('premierFilm',ChoiceType::class,[
                                                                          'choices'  => [
                                                                              'Prémier film' => 'premier film',
                                                                       
                                                                          ],
                                                                          'expanded' => true,
                                                                          'required' => false,
                                                                          'multiple' => true,
                                                                          
              
                                                                      ]
                   )
            ->add('adaptationOeuvre',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                               'Oui' => true,
                                                               'Non' => false,
                                                           ],
                                                           'expanded' => true,
                                                           'required' => false,
                                                           'multiple' => false,
                                                           
                                                         ]
                  )
            ->add('adaptationOeuvreToa',TextType::class,[ 'required'=>false])
            ->add('adaptationOeuvreDacp',TextType::class,[ 'required'=>false])
            ->add('adaptationOeuvreDfc',DateType::class,
                                                        [
                                                          'widget' => 'single_text',
                                                          'attr' => ['class' => 'w-75'],
                                                          'required'=>false,
                                                        ]
                  )
            ->add('deposant',ChoiceType::class,
                                                [
                                                  'choices'  => [
                                                    'Le producteur' => true, 
                                                    'auteur.s/réalisateur.s' => false,
                                                  ],
                                                  'expanded' => true,
                                                  'required' => false,
                                                  'multiple' => false,
                                                  
                                                ]
                )
               ->add('producteurs',CollectionType::class,
                                                           [
                                                            'entry_type'=>ProducteurType::class,
                                                            'allow_add'=>true,
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
                ->add('projetPresentes',CollectionType::class,
                                                                   [
                                                                     'entry_type'=>ProjetPresenteType::class,
                                                                     'allow_add'=>true,
                                                                     'allow_delete'=>true,
                                                                   ]
                      )
               ->add('mtTotalProgrammeDeveloppement',TextType::class,['required'=>false])
               ->add('nombreSalariePermanent',TextType::class,['required'=>false])
               ->add('nombreSalarieIntermittent',TextType::class,['required'=>false])
               ->add('salarieIntermittentth',TextType::class,['required'=>false])
               ->add('salariePermenentEqtemps',TextType::class,['required'=>false])
               ->add('typeAideLm',ChoiceType::class,
                                                    [
                                                      'choices'  => [
                                                        'Écriture' => 'ecriture',
                                                        'Réécriture' => 'reecriture',
                                                      ],
                                                      'expanded' => true,
                                                      'required' => false,
                                                      'multiple' => false,
                                                      
                                                    ]
                                                                          
                    )
            ->add('typeAideDoc',ChoiceType::class, [
                                                      'choices'  => [
                                                      'Écriture' => 'ecriture',
                                                      'Développement' => 'developpement',
                                                      ],
                                                      'expanded' => true,
                                                      'required' => false,
                                                      'multiple' => false,
                                                      
                                                  ]

                  )
            ->add('mtBudget',TextType::class,[ 'required'=>false])
            ->add('liensEligibilite',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                             'Auteur réalisateur domicilié en région Normandie'=>'un auteur realisateur domicilie en région Normandie',
                                                             'Société de production disposant d’un établissement stable en région Normandie'=>'une société de production disposant d’un établissement stable en région Normandie',
                                                             'Projet entretenant un lien culturel avec la région Normandie'=>'un projet entretenant un lien culturel avec la région Normandie',
                                                             'Auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années '=>'un auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années ',
                                                             'Projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années'=>'un projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années',
                                                           ],
                                                           'expanded' => true,
                                                           'required' => false,
                                                           'multiple' => true,
                                                        ]
                  )
            ->add('datePreparation',TextType::class,[ 'required'=>false])
            ->add('dateTournage',TextType::class,[ 'required'=>false])
            ->add('dateDiffusion',TextType::class,[ 'required'=>false])
            ->add('castingEnvisage',TextType::class,[ 'required'=>false])
            ->add('lieuxTournage',TextareaType::class,[ 'required'=>false])
            ->add('nombreJoursTournage',TextType::class,[ 'required'=>false])
            ->add('nombreJoursTotal',TextType::class,[ 'required'=>false])
            ->add('droitArtistiqueTotalHt',TextType::class,[ 'required'=>false])
            ->add('droitArtistiqueTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('droitArtistiqueCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('personnelTotalHt',TextType::class,[ 'required'=>false])
            ->add('personnelTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('personnelCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('interpretationTotalHt',TextType::class,[ 'required'=>false])
            ->add('interpretationTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('interpretationCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('totalChargeSocialesTotalHt',TextType::class,[ 'required'=>false])
            ->add('totalChargeSocialesTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('totalChargeSocialesCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('decoEtCostumesTotalHt',TextType::class,[ 'required'=>false])
            ->add('decoEtCostumesTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('decoEtCostumesCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('transportTotalHt',TextType::class,[ 'required'=>false])
            ->add('transportTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('transportCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('moyenTechniqueTournageTotalHt',TextType::class,[ 'required'=>false])
            ->add('moyenTechniqueTournageTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('moyenTechniqueCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('pelliculesTotalHt',TextType::class,[ 'required'=>false])
            ->add('pelliculesTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('pelliculesCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('assuranceEtFraisTotalHt',TextType::class,[ 'required'=>false])
            ->add('assuranceFrance',TextType::class,['required'=>false])
            ->add('assuranceEtFraisTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('assuranceEtFraisCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('totalPartielTotalHt',TextType::class,[ 'required'=>false])
            ->add('totalPartielFrance',TextType::class,['required'=>false])
            ->add('totalPartielTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('totalPartielCoutDefinitif',TextType::class,[ 'required'=>false])
            ->add('fraisGenerauxTotalHT',TextType::class,['required'=>false])
            ->add('fraisGenerauxDepenseFrance',TextType::class,['required'=>false])
            ->add('fraisGenerauxNormandie',TextType::class,['required'=>false])
            ->add('fraisGenerauxCoutDefinitif',TextType::class,['required'=>false])
            ->add('imprevusTotalHT',TextType::class,['required'=>false])
            ->add('imprevusDepenseFrance',TextType::class,['required'=>false])
            ->add('imprevusNormandie',TextType::class,['required'=>false])
            ->add('imprevusCoutDefinitif',TextType::class,['required'=>false])
            ->add('totalGeneralTotalHt',TextType::class,['required'=>false])
            ->add('totalGeneralTotalHtNormandie',TextType::class,['required'=>false])
            ->add('totalGeneralCoutDefinitif',TextType::class,['required'=>false])
            ->add('droitArtistiquesFrance',TextType::class,['required'=>false])
            ->add('transportFrance',TextType::class,['required'=>false])
            ->add('personnelFrance',TextType::class,['required'=>false])
            ->add('interpretationFrance',TextType::class,['required'=>false])
            ->add('moyenTechniqueFrance',TextType::class,['required'=>false])
            ->add('pelliculesFrance',TextType::class,['required'=>false])
            ->add('chargeSocialeFrance',TextType::class,['required'=>false])
            ->add('decoEtCostumesFrance',TextType::class,['required'=>false])
            ->add('totalGeneralFrance',TextType::class,['required'=>false])
            ->add('financementAcquis',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                               'Oui' => true,
                                                               'Non' => false,
                                                           ],
                                                           'expanded' => true,
                                                           'required' => false,
                                                           'multiple' => false,
                                                           
                                                         ]
                 )         
            ->add('financementAcquisPrecision',TextType::class,[ 'required'=>false])
            ->add('productionTv',TextType::class,[ 'required'=>false])
            ->add('preachatTv',TextType::class,[ 'required'=>false])
            ->add('montantSollicite',TextType::class,[ 'required'=>false])
            ->add('depotProjetCollectivite',ChoiceType::class,[
                                                               'choices'  => [
                                                                   'Oui' => true,
                                                                   'Non' => false,
                                                               ],
                                                               'expanded' => true,
                                                               'required' => false,
                                                               'multiple' => false,
                                                               
                                                             ]
                 )
            ->add('depotProjetCollectivitePrecision',TextType::class,[ 'required'=>false])
            ->add('projetDejaPresenteFondsAide',ChoiceType::class,[
                                                                    'choices'  => [
                                                                        'Oui' => true,
                                                                        'Non' => false,
                                                                    ],
                                                                    'expanded' => true,
                                                                    'required' => false,
                                                                    'multiple' => false,
                                                                    
                                                                  ]
                 )
            ->add('projetDejaPresenteFondsAideDate',TextType::class,[ 'required'=>false])
            ->add('projetDejaPresenteFondsAideTypeAide',TextType::class,[ 'required'=>false])
            ->add('mailUtilisateur',EmailType::class)
            ->add('courrierdemande',VichFileType::class,[  
                                               'required' => false,
                                               'allow_delete' => true,
                                               'download_uri' => true,
                                               'delete_label' => 'Supprimer le fichier existant ?',
                                               'download_label' => 'Voir le fichier',
          
                                              ]
                 ) 
            ->add('dossierartistique',VichFileType::class,[  
                                                         'required' => false,
                                                         'allow_delete' => true,
                                                         'download_uri' => true,
                                                         'delete_label' => 'Supprimer le fichier existant ?',
                                                         'download_label' => 'Voir le fichier',

                                                        ]
                ) 
             ->add('devisPrevisionnel',VichFileType::class,[  
                                                          'required' => false,
                                                          'allow_delete' => true,
                                                          'download_uri' => true,
                                                          'delete_label' => 'Supprimer le fichier existant ?',
                                                          'download_label' => 'Voir le fichier',

                                                        ]
                   ) 
             ->add('planFinancement',VichFileType::class,[  
                                                       'required' => false,
                                                       'allow_delete' => true,
                                                       'download_uri' => true,
                                                       'delete_label' => 'Supprimer le fichier existant ?',
                                                       'download_label' => 'Voir le fichier',
                                                     ]
                  )   
            ->add('contrat',VichFileType::class,[  
                                                       'required' => false,
                                                       'allow_delete' => true,
                                                       'download_uri' => true,
                                                       'delete_label' => 'Supprimer le fichier existant ?',
                                                       'download_label' => 'Voir le fichier',

                                                     ]
                ) 
            ->add('justificatifdiffusion',VichFileType::class,[  
                                                      'required' => false,
                                                      'allow_delete' => true,
                                                      'download_uri' => true,
                                                      'delete_label' => 'Supprimer le fichier existant ?',
                                                      'download_label' => 'Voir le fichier',
                                                      
                                                     ]
                )  
           ->add('finsee',VichFileType::class,[  
                                                    'required' => false,
                                                    'allow_delete' => true,
                                                    'download_uri' => true,
                                                    'delete_label' => 'Supprimer le fichier existant ?',
                                                    'download_label' => 'Voir le fichier',
                                                  ]
                 ) 
           ->add('rib',VichFileType::class,[  
                                               'required' => false,
                                               'allow_delete' => true,
                                               'download_uri' => true,
                                               'delete_label' => 'Supprimer le fichier existant ?',
                                               'download_label' => 'Voir le fichier',
                                            ]
               ) 
           ->add('engagement',VichFileType::class,[  
                                                    'required' => false,
                                                    'allow_delete' => true,
                                                    'download_uri' => true,
                                                    'delete_label' => 'Supprimer le fichier existant ?',
                                                    'download_label' => 'Voir le fichier',
                                                  ]
                )
            ->add('justificatifeligibilite',VichFileType::class,[  
                                               'required' => false,
                                               'allow_delete' => true,
                                               'download_uri' => true,
                                               'delete_label' => 'Supprimer le fichier existant ?',
                                               'download_label' => 'Voir le fichier',

                                              ]
                )  
            ->add('dossierpresentation',VichFileType::class,[  
                                                        'required' => false,
                                                        'allow_delete' => true,
                                                        'download_uri' => true,
                                                        'delete_label' => 'Supprimer le fichier existant ?',
                                                        'download_label' => 'Voir le fichier',

                                                      ]
                ) 
            ->add('budgetprevisionnel',VichFileType::class,[  
                                                      'required' => false,
                                                      'allow_delete' => true,
                                                      'download_uri' => true,
                                                      'delete_label' => 'Supprimer le fichier existant ?',
                                                      'download_label' => 'Voir le fichier',
                                                    ]
               )  
            ->add('attestationvigilance',VichFileType::class,[  
                                                     'required' => false,
                                                     'allow_delete' => true,
                                                     'download_uri' => true,
                                                     'delete_label' => 'Supprimer le fichier existant ?',
                                                     'download_label' => 'Voir le fichier',

                                                     ]
                )   
            ->add('declarationaide',VichFileType::class,[  
                                                    'required' => false,
                                                    'allow_delete' => true,
                                                    'download_uri' => true,
                                                    'delete_label' => 'Supprimer le fichier existant ?',
                                                    'download_label' => 'Voir le fichier',
                                                   ]
                )  
            ->add('enregistrer',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
