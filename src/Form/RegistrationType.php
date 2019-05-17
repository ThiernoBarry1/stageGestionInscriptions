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
            ->add('titre',TextType::class)
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
            ->add('formatTournage',TextType::class)
            ->add('formatDefinitif',TextType::class)
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
              ->add('typeOeuvre',TextType::class)
             ->add('genrePrecisionAutre',TextType::class)
            ->add('synopsis',TextareaType::class)
            ->add('adaptationOeuvre',ChoiceType::class,
                        $this->getArrayChoice(
                                               ['Oui' => true, 
                                                'Non' => false,
                                               ]
                                             )
                  )
            ->add('adaptationOeuvreToa',TextType::class)
            ->add('adaptationOeuvreDacp',TextType::class)
            ->add('adaptationOeuvreDfc',DateType::class,
                                                        [
                                                          'widget' => 'single_text',
                                                          'attr' => ['class' => 'w-75']
                                                        ]
                  )
            ->add('deposant',ChoiceType::class,
                $this->getArrayChoice(
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
               ->add('typeAideLm',ChoiceType::class,
                      $this->getArrayChoice(
                                             [
                                               'Écriture' => true,
                                               'Réécriture' => false,
                                             ]
                                           )
                    )
            ->add('typeAideDoc',ChoiceType::class,
                    $this->getArrayChoice(
                                          [
                                            'Écriture' => true,
                                            'Développement' => false,
                                          ]
                                        )
                  )
            ->add('mtBudget',TextType::class)
            ->add('liensEligibilite',ChoiceType::class,$this->getArrayChoice(
                                                                              ['Un auteur réalisateur domicilié en région Normandie'=>true,
                                                                               'Une société de production disposant d’un établissement stable en région Normandie'=>false,
                                                                               'Un projet entretenant un lien culturel avec la région Normandie'=>false,
                                                                               'Un auteur réalisateur ayant obtenu une aide à la production d’œuvre cinématographique de courte durée, de longue durée ou de documentaire de la Région Normandie au cours des 5 dernières années '=>false,
                                                                              'Un projet d’œuvre cinématographique de longue durée ayant bénéficié d’une résidence d’écriture au CECI-Moulin d’Andé ou dans tout autre lieu de résidence d\'écriture reconnu en Normandie au cours des 5 dernières années'=>false,
                                                                             ],true
                                                                            )
                  )
            ->add('datePreparation',TextType::class)
            ->add('dateTournage',TextType::class)
            ->add('dateDiffusion',TextType::class)
            ->add('castingEnvisage',TextType::class)
            ->add('listeLieuxTournage',TextareaType::class)
            ->add('nombreJoursTournage',TextType::class)
            ->add('nombreJoursTotal',TextType::class)
            ->add('droitArtistiqueTotalHt',TextType::class)
            ->add('droitArtistiqueTotalHtNormandie',TextType::class)
            ->add('personnelTotalHt',TextType::class)
            ->add('personnelTotalHtNormandie')
            ->add('interpretationTotalHt',TextType::class)
            ->add('interpretationTotalHtNormandie',TextType::class)
            ->add('totalChargeSocialesTotalHt',TextType::class)
            ->add('totalChargeSocialesTotalHtNormandie',TextType::class)
            ->add('decoEtCostumesTotalHt',TextType::class)
            ->add('decoEtCostumesTotalHtNormandie',TextType::class)
            ->add('transportTotalHt',TextType::class)
            ->add('transportTotalHtNormandie',TextType::class)
            ->add('moyenTechniqueTournageTotalHt',TextType::class)
            ->add('postProdTotalHt',TextType::class)
            ->add('moyenTechniqueTournageTotalHtNormandie',TextType::class)
            ->add('postProdTotalHtNormandie',TextType::class)
            ->add('assuranceEtFraisTotalHt',TextType::class)
            ->add('assuranceEtFraisTotalHtNormandie',TextType::class)
            ->add('fraisFinanciersTotalHt',TextType::class)
            ->add('fraisFinanciersTotalHtNormandie',TextType::class)
            ->add('fraisGenerauxTotalHt',TextType::class)
            ->add('fraisGenerauxTotalHtNormandie',TextType::class)
            ->add('imprevusTotalHt',TextType::class)
            ->add('imprevusTotalHtNormandie',TextType::class)
            ->add('totalGeneralTotalHt',TextType::class,['disabled'=>true])
            ->add('totalGeneralTotalHtNormandie',TextType::class,['disabled'=>true])
            ->add('financementAcquis',ChoiceType::class,
                     $this->getArrayChoice(
                                             [
                                              'Oui'=>true,
                                              'Non'=>false
                                              ]
                                           )
                  )
            ->add('financementAcquisPrecision',TextType::class)
            ->add('montantSollicite',TextType::class)
            ->add('depotProjetCollectivite',ChoiceType::class,
                   $this->getArrayChoice(
                                          [
                                            'Oui'=>true,
                                            'Non'=>false
                                          ]
                                       )
                 )
            ->add('depotProjetCollectivitePrecision',TextType::class)
            ->add('projetDejaPresenteFondsAide',ChoiceType::class,$this->getArrayChoice(
                                                                                          [
                                                                                            'Oui'=>true,
                                                                                            'Non'=>false
                                                                                          ]
                                                                                       )
                 )
            ->add('projetDejaPresenteFondsAideDate',TextType::class)
            ->add('projetDejaPresenteFondsAideTypeAide',TextType::class)  
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
