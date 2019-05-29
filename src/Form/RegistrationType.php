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
use App\Form\DataTransform\TransformeurDate;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistrationType extends ConfigurationFildsType
{ 
   // pour la transforamtion de la date de fin de section au format français en datetime 
   private $dateTransformeur; 

   public function __construct(TransformeurDate $dateTransformeur)
    {
      $this->dateTransformeur = $dateTransformeur;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[ 'required'=>false])
            ->add('duree',IntegerType::class,
                                              [
                                               'required' => false,
                                               'attr' => [
                                                          'min' => 0,
                                                          'max' => 300,
                                                          'step' => 1,
                                                         ]
                                              ]
                   )
            ->add('typeFilm',ChoiceType::class,
                                         [
                                          'choices'  => [
                                              'Unitaire'=>'unitaire',
                                              'Serie'=>'serie'
                                          ],
                                          'expanded' => true,
                                          'required' => true,
                                          'multiple' => false,
                                        ]
                )
            ->add('dureeEpisode',IntegerType::class,
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
                                              'required' => true,
                                              'multiple' => false,
                                            ]
                  )
            ->add('typeOeuvre',TextType::class,[ 'required'=>false])
            ->add('genrePrecisionAutre',TextType::class,[ 'required'=>false])
            ->add('synopsis',TextareaType::class,[ 'required'=>false])
            ->add('adaptationOeuvre',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                               'Oui' => true,
                                                               'Non' => false,
                                                           ],
                                                           'expanded' => true,
                                                           'required' => true,
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
                                                    'L\'auteur/le réalisateur' => false,
                                                  ],
                                                  'expanded' => true,
                                                  'required' => true,
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
               ->add('typeAideLm',ChoiceType::class,
                                                    [
                                                      'choices'  => [
                                                        'Écriture' => 'Écriture',
                                                        'Réécriture' => 'Réécriture',
                                                      ],
                                                      'expanded' => true,
                                                      'required' => true,
                                                      'multiple' => false,
                                                    ]
                                                                          
                    )
            ->add('typeAideDoc',ChoiceType::class, [
                                                      'choices'  => [
                                                      'Écriture' => 'Écriture',
                                                      'Développement' => 'Développement',
                                                      ],
                                                      'expanded' => true,
                                                      'required' => true,
                                                      'multiple' => false,
                                                  ]

                  )
            ->add('mtBudget',TextType::class,[ 'required'=>false])
            ->add('liensEligibilite',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                             'Un auteur réalisateur domicilié en région Normandie'=>'Un auteur réalisateur domicilié en région Normandie',
                                                             'Une société de production disposant d’un établissement stable en région Normandie'=>'Une société de production disposant d’un établissement stable en région Normandie',
                                                             'Un projet entretenant un lien culturel avec la région Normandie'=>'Un projet entretenant un lien culturel avec la région Normandie',
                                                             'Un auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années '=>'Un auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années ',
                                                             'Un projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années'=>'Un projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années',
                                                           ],
                                                           'expanded' => true,
                                                           'required' => true,
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
            ->add('personnelTotalHt',TextType::class,[ 'required'=>false])
            ->add('personnelTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('interpretationTotalHt',TextType::class,[ 'required'=>false])
            ->add('interpretationTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('totalChargeSocialesTotalHt',TextType::class,[ 'required'=>false])
            ->add('totalChargeSocialesTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('decoEtCostumesTotalHt',TextType::class,[ 'required'=>false])
            ->add('decoEtCostumesTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('transportTotalHt',TextType::class,[ 'required'=>false])
            ->add('transportTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('moyenTechniqueTournageTotalHt',TextType::class,[ 'required'=>false])
            ->add('postProdTotalHt',TextType::class,[ 'required'=>false])
            ->add('moyenTechniqueTournageTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('postProdTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('assuranceEtFraisTotalHt',TextType::class,[ 'required'=>false])
            ->add('assuranceEtFraisTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('fraisFinanciersTotalHt',TextType::class,[ 'required'=>false])
            ->add('fraisFinanciersTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('fraisGenerauxTotalHt',TextType::class,[ 'required'=>false])
            ->add('fraisGenerauxTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('imprevusTotalHt',TextType::class,[ 'required'=>false])
            ->add('imprevusTotalHtNormandie',TextType::class,[ 'required'=>false])
            ->add('totalGeneralTotalHt',TextType::class,['required'=>false])
            ->add('totalGeneralTotalHtNormandie',TextType::class,['required'=>false])
            ->add('financementAcquis',ChoiceType::class,
                                                         [
                                                           'choices'  => [
                                                               'Oui' => true,
                                                               'Non' => false,
                                                           ],
                                                           'expanded' => true,
                                                           'required' => true,
                                                           'multiple' => false,
                                                         ]
                 )         
            ->add('financementAcquisPrecision',TextType::class,[ 'required'=>false])
            ->add('montantSollicite',TextType::class,[ 'required'=>false])
            ->add('depotProjetCollectivite',ChoiceType::class,[
                                                               'choices'  => [
                                                                   'Oui' => true,
                                                                   'Non' => false,
                                                               ],
                                                               'expanded' => true,
                                                               'required' => true,
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
                                                                    'required' => true,
                                                                    'multiple' => false,
                                                                  ]
                 )
            ->add('projetDejaPresenteFondsAideDate',TextType::class,[ 'required'=>false])
            ->add('projetDejaPresenteFondsAideTypeAide',TextType::class,[ 'required'=>false])
            ->add('file',FileType::class,[ 'required'=>false])  
            ->add('enregistrer',SubmitType::class)
            ;
            // pour la transforamtion de la date de fin de section au format français en datetime 
            //$builder->get('adaptationOeuvreDfc')->addModelTransformer($this->dateTransformeur);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
