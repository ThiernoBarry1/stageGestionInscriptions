<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Valid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 * @Vich\Uploadable
 */
class Projet implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir mois de 255 caractères pour le titre")
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir mois de 255 caractères")
     */
    private $formatTournage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir mois de 255 caractères")
     */
    private $formatDefinitif;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20,maxMessage="Merci de saisir mois de 20 caractères")
     */
    private $genre;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=500,maxMessage="le synopsis ne dois pas dépasser 500 caractères")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $adaptationOeuvre;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $deposant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="projets")
     */
    private $session;
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AuteurRealisateur",  cascade={"persist"},mappedBy="projet", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $auteurRealisateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DocumentAudioVisuels", cascade={"persist"}, mappedBy="projet")
     * @Assert\Valid()
     */
    private $documentAudioVisuels;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $typeAideLm;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * * @Assert\Length(max=20,maxMessage="merci de saisir mois de 20 caractères")
     */
    private $typeAideDoc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moin de 255 caractères")
     */
    private $mtBudget;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $liensEligibilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moin de 255 caractères")
     */
    private $datePreparation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Assert\Length(max=255,maxMessage="merci de saisir moin de 255 caractères")
     */
    private $dateTournage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moin de 255 caractères")
     */
    private $dateDiffusion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $castingEnvisage;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $lieuxTournage;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nombreJoursTournage;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nombreJoursTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $droitArtistiqueTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $droitArtistiqueTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $personnelTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $personnelTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interpretationTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interpretationTotalHtNormandie;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $totalChargeSocialesTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalChargeSocialesTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $decoEtCostumesTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $decoEtCostumesTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $transportTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $transportTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenTechniqueTournageTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pelliculesTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenTechniqueTournageTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pelliculesTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assuranceEtFraisTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assuranceEtFraisTotalHtNormandie;

    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPartielTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPartielTotalHtNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalGeneralTotalHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalGeneralTotalHtNormandie;

    /**
     * @ORM\Column(type="string",  length=3,nullable=true)
     */
    private $financementAcquis;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $financementAcquisPrecision;

    /**
     * @ORM\Column(type="string", length=3,nullable=true)
     */
    private $depotProjetCollectivite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $depotProjetCollectivitePrecision;

    /**
     * @ORM\Column(type="string",length=3, nullable=true)
     */
    private $projetDejaPresenteFondsAide;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     * @Assert\Length(max=55,maxMessage="Merci de saisir mois de 55 caractères")
     */
    private $projetDejaPresenteFondsAideDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $projetDejaPresenteFondsAideTypeAide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $genrePrecisionAutre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de renseigner mois de 255 caractères")
     */
    private $adaptationOeuvreToa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $adaptationOeuvreDacp;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime(message="Cette date n'est pas une date valide")
     */
    private $adaptationOeuvreDfc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir moins de 255 caractères")
     */
    private $montantSollicite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Producteur", cascade={"persist"}, mappedBy="projet", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $producteurs;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime(message="cette date n'est pas une date valide")
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime(message="cette date n'est pas une date valide")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=25,nullable=true)
     * @Assert\Length(max=25,maxMessage="merci de saisir moins de 25 caractères")
     */
    private $typeFilm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir moins de 255 caractères")
     */
    private $typeOeuvre;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $dureeEpisode;

    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierCourrierdemande")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $courrierdemande;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierCourrierdemande;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtCourrierdemande;

    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierDossierartistique")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $dossierartistique;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierDossierartistique;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtDossierartistique;
    
   /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierDevisPrevisionnel")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $devisPrevisionnel;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierDevisPrevisionnel;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtDevisPrevisionnel;


    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierPlanFinancement")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $planFinancement;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierPlanFinancement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtPlanFinancement;


     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierContrat")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $contrat;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierContrat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtContrat;


     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierJustificatifdiffusion")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $justificatifdiffusion;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierJustificatifdiffusion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtJustificatifdiffusion;
    
     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierfinsee")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $finsee;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierfinsee;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtfinsee;


     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierrib")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $rib;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierrib;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtrib;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le mot de pass ne doit pas dépasser 255 caractères")
     */

     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierengagement")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $engagement;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierengagement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtengagement;
    
     /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierJustificatifeligibilite")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $justificatifeligibilite;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierJustificatifeligibilite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtJustificatifeligibilite;

    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierDossierpresentation")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $dossierpresentation;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierDossierpresentation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtDossierpresentation;
    
    
    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierBudgetprevisionnel")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $budgetprevisionnel;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierBudgetprevisionnel;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtBudgetprevisionnel;


    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierAttestationvigilance")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $attestationvigilance;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierAttestationvigilance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtAttestationvigilance;


    /**
     * le fichier à télécharger
     * 
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichierDeclarationaide")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $declarationaide;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichierDeclarationaide;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAtDeclarationaide;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le mot de pass ne doit pas dépasser 255 caractères")
     */
    private $motpassehass;
      
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="L'adresse mail que vous avez indiqué n'est pas valide")
     */
    private $mailUtilisateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $token_date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $droitArtistiquesFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $personnelFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interpretationFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $chargeSocialeFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $decoEtCostumesFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $transportFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenTechniqueFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pelliculesFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assuranceFrance;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPartielFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalGeneralFrance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $productionTv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $preachatTv;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(max=10,maxMessage="merci de saisir moins de 10 caractères")
     */
    private $nombreEpisode;

   
    /**
     * @ORM\Column(type="array",nullable=true)
     */
    
    private $premierFilm;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $droitArtistiqueCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $personnelCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interpretationCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalChargeSocialesCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $decoEtCostumesCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $transportCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenTechniqueCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pelliculesCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assuranceEtFraisCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPartielCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fraisGenerauxCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $imprevusCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalGeneralCoutDefinitif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fraisGenerauxTotalHT;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fraisGenerauxDepenseFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fraisGenerauxNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $imprevusDepenseFrance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $imprevusNormandie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $imprevusTotalHT;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreSalariePermanent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreSalarieIntermittent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $salariePermenentEqtemps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $salarieIntermittentth;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjetPresente",cascade={"persist"}, mappedBy="projet", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $projetPresentes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $mtTotalProgrammeDeveloppement;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(max=10,maxMessage="merci de saisir moins de 10 caractères")
     */
    private $whoIsSubmitted;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $status;

    

    public function __construct()
    {
        $this->auteurRealisateurs = new ArrayCollection();
        $this->documentAudioVisuels = new ArrayCollection();
        $this->producteurs = new ArrayCollection();
        $this->projetPresentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getFormatTournage(): ?string
    {
        return $this->formatTournage;
    }

    public function setFormatTournage(string $formatTournage): self
    {
        $this->formatTournage = $formatTournage;

        return $this;
    }

    public function getFormatDefinitif(): ?string
    {
        return $this->formatDefinitif;
    }

    public function setFormatDefinitif(?string $formatDefinitif): self
    {
        $this->formatDefinitif = $formatDefinitif;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getAdaptationOeuvre(): ?string
    {
        return $this->adaptationOeuvre;
    }

    public function setAdaptationOeuvre(string $adaptationOeuvre): self
    {
        $this->adaptationOeuvre = $adaptationOeuvre;

        return $this;
    }

    public function getDeposant()
    {
        return $this->deposant;
    }

    public function setDeposant( $deposant): self
    {
        $this->deposant = $deposant;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return Collection|AuteurRealisateur[]
     */
    public function getAuteurRealisateurs(): Collection
    {
        return $this->auteurRealisateurs;
    }

    public function addAuteurRealisateur(AuteurRealisateur $auteurRealisateur): self
    {
        if (!$this->auteurRealisateurs->contains($auteurRealisateur)) {
            $this->auteurRealisateurs[] = $auteurRealisateur;
            $auteurRealisateur->setProjet($this);
        }

        return $this;
    }

    public function removeAuteurRealisateur(AuteurRealisateur $auteurRealisateur): self
    {
        if ($this->auteurRealisateurs->contains($auteurRealisateur)) {
            $this->auteurRealisateurs->removeElement($auteurRealisateur);
            // set the owning side to null (unless already changed)
            if ($auteurRealisateur->getProjet() === $this) {
                $auteurRealisateur->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocumentAudioVisuels[]
     */
    public function getDocumentAudioVisuels(): Collection
    {
        return $this->documentAudioVisuels;
    }

    public function addDocumentAudioVisuel(DocumentAudioVisuels $documentAudioVisuel): self
    {
        if (!$this->documentAudioVisuels->contains($documentAudioVisuel)) {
            $this->documentAudioVisuels[] = $documentAudioVisuel;
            $documentAudioVisuel->setProjet($this);
        }

        return $this;
    }

    public function removeDocumentAudioVisuel(DocumentAudioVisuels $documentAudioVisuel): self
    {
        if ($this->documentAudioVisuels->contains($documentAudioVisuel)) {
            $this->documentAudioVisuels->removeElement($documentAudioVisuel);
            // set the owning side to null (unless already changed)
            if ($documentAudioVisuel->getProjet() === $this) {
                $documentAudioVisuel->setProjet(null);
            }
        }

        return $this;
    }

    public function getTypeAideLm(): ?string
    {
        return $this->typeAideLm;
    }

    public function setTypeAideLm(?string $typeAideLm): self
    {
        $this->typeAideLm = $typeAideLm;

        return $this;
    }

    public function getTypeAideDoc(): ?string
    {
        return $this->typeAideDoc;
    }

    public function setTypeAideDoc(?string $typeAideDoc): self
    {
        $this->typeAideDoc = $typeAideDoc;

        return $this;
    }

    public function getMtBudget(): ?string
    {
        return $this->mtBudget;
    }

    public function setMtBudget(?string $mtBudget): self
    {
        $this->mtBudget = $mtBudget;

        return $this;
    }

    public function getLiensEligibilite(): ?array
    {
        return $this->liensEligibilite;
    }

    public function setLiensEligibilite(?array $liensEligibilite): self
    {
        $this->liensEligibilite = $liensEligibilite;

        return $this;
    }

    public function getDatePreparation(): ?string
    {
        return $this->datePreparation;
    }

    public function setDatePreparation(?string $datePreparation): self
    {
        $this->datePreparation = $datePreparation;

        return $this;
    }

    public function getDateTournage(): ?string
    {
        return $this->dateTournage;
    }

    public function setDateTournage(?string $dateTournage): self
    {
        $this->dateTournage = $dateTournage;

        return $this;
    }

    public function getDateDiffusion(): ?string
    {
        return $this->dateDiffusion;
    }

    public function setDateDiffusion(?string $dateDiffusion): self
    {
        $this->dateDiffusion = $dateDiffusion;

        return $this;
    }

    public function getCastingEnvisage(): ?string
    {
        return $this->castingEnvisage;
    }

    public function setCastingEnvisage(?string $castingEnvisage): self
    {
        $this->castingEnvisage = $castingEnvisage;

        return $this;
    }

    public function getLieuxTournage()
    {
        return $this->lieuxTournage;
    }

    public function setLieuxTournage( $lieuxTournage): self
    {
        $this->lieuxTournage = $lieuxTournage;

        return $this;
    }

    public function getNombreJoursTournage(): ?int
    {
        return $this->nombreJoursTournage;
    }

    public function setNombreJoursTournage(int $nombreJoursTournage): self
    {
        $this->nombreJoursTournage = $nombreJoursTournage;

        return $this;
    }

    public function getNombreJoursTotal(): ?int
    {
        return $this->nombreJoursTotal;
    }

    public function setNombreJoursTotal(int $nombreJoursTotal): self
    {
        $this->nombreJoursTotal = $nombreJoursTotal;

        return $this;
    }

    public function getDroitArtistiqueTotalHt(): ?float
    {
        return $this->droitArtistiqueTotalHt;
    }

    public function setDroitArtistiqueTotalHt(?float $droitArtistiqueTotalHt): self
    {
        $this->droitArtistiqueTotalHt = $droitArtistiqueTotalHt;

        return $this;
    }

    public function getDroitArtistiqueTotalHtNormandie(): ?int
    {
        return $this->droitArtistiqueTotalHtNormandie;
    }

    public function setDroitArtistiqueTotalHtNormandie(?int $droitArtistiqueTotalHtNormandie): self
    {
        $this->droitArtistiqueTotalHtNormandie = $droitArtistiqueTotalHtNormandie;

        return $this;
    }

    public function getPersonnelTotalHt(): ?int
    {
        return $this->personnelTotalHt;
    }

    public function setPersonnelTotalHt(?int $personnelTotalHt): self
    {
        $this->personnelTotalHt = $personnelTotalHt;

        return $this;
    }

    public function getPersonnelTotalHtNormandie(): ?int
    {
        return $this->personnelTotalHtNormandie;
    }

    public function setPersonnelTotalHtNormandie(?int $personnelTotalHtNormandie): self
    {
        $this->personnelTotalHtNormandie = $personnelTotalHtNormandie;

        return $this;
    }

    public function getInterpretationTotalHt(): ?float
    {
        return $this->interpretationTotalHt;
    }
    public function setInterpretationTotalHt(?float $interpretationTotalHt): self
    {
        $this->interpretationTotalHt = $interpretationTotalHt;

        return $this;
    }
    
    public function getInterpretationTotalHtNormandie(): ?float
    {
        return $this->interpretationTotalHtNormandie;
    }
    public function setInterpretationTotalHtNormandie(?float $interpretationTotalHtNormandie): self
    {
        $this->interpretationTotalHtNormandie = $interpretationTotalHtNormandie;

        return $this;
    }

    public function getTotalChargeSocialesTotalHt(): ?float
    {
        return $this->totalChargeSocialesTotalHt;
    }

    public function setTotalChargeSocialesTotalHt(float $totalChargeSocialesTotalHt): self
    {
        $this->totalChargeSocialesTotalHt = $totalChargeSocialesTotalHt;

        return $this;
    }

    public function getTotalChargeSocialesTotalHtNormandie(): ?float
    {
        return $this->totalChargeSocialesTotalHtNormandie;
    }

    public function setTotalChargeSocialesTotalHtNormandie(?float $totalChargeSocialesTotalHtNormandie): self
    {
        $this->totalChargeSocialesTotalHtNormandie = $totalChargeSocialesTotalHtNormandie;

        return $this;
    }

    public function getDecoEtCostumesTotalHt(): ?float
    {
        return $this->decoEtCostumesTotalHt;
    }

    public function setDecoEtCostumesTotalHt(?float $decoEtCostumesTotalHt): self
    {
        $this->decoEtCostumesTotalHt = $decoEtCostumesTotalHt;

        return $this;
    }

    public function getDecoEtCostumesTotalHtNormandie(): ?float
    {
        return $this->decoEtCostumesTotalHtNormandie;
    }

    public function setDecoEtCostumesTotalHtNormandie(?float $decoEtCostumesTotalHtNormandie): self
    {
        $this->decoEtCostumesTotalHtNormandie = $decoEtCostumesTotalHtNormandie;

        return $this;
    }

    public function getTransportTotalHt(): ?float
    {
        return $this->transportTotalHt;
    }

    public function setTransportTotalHt(?float $transportTotalHt): self
    {
        $this->transportTotalHt = $transportTotalHt;

        return $this;
    }

    public function getTransportTotalHtNormandie(): ?float
    {
        return $this->transportTotalHtNormandie;
    }

    public function SetTransportTotalHtNormandie(?float $transportTotalHtNormandie): self
    {
        $this->transportTotalHtNormandie = $transportTotalHtNormandie;

        return $this;
    }

    public function getMoyenTechniqueTournageTotalHt(): ?float
    {
        return $this->moyenTechniqueTournageTotalHt;
    }

    public function setMoyenTechniqueTournageTotalHt(?float $moyenTechniqueTournageTotalHt): self
    {
        $this->moyenTechniqueTournageTotalHt = $moyenTechniqueTournageTotalHt;

        return $this;
    }

    public function getPelliculesTotalHt(): ?float
    {
        return $this->pelliculesTotalHt;
    }

    public function setPelliculesTotalHt(?float $pelliculesTotalHt): self
    {
        $this->pelliculesTotalHt = $pelliculesTotalHt;

        return $this;
    }

    public function getMoyenTechniqueTournageTotalHtNormandie(): ?float
    {
        return $this->moyenTechniqueTournageTotalHtNormandie;
    }

    public function setMoyenTechniqueTournageTotalHtNormandie(?float $moyenTechniqueTournageTotalHtNormandie): self
    {
        $this->moyenTechniqueTournageTotalHtNormandie = $moyenTechniqueTournageTotalHtNormandie;

        return $this;
    }

    public function getPelliculesTotalHtNormandie(): ?float
    {
        return $this->pelliculesTotalHtNormandie;
    }

    public function setPelliculesTotalHtNormandie(?float $pelliculesTotalHtNormandie): self
    {
        $this->pelliculesTotalHtNormandie = $pelliculesTotalHtNormandie;

        return $this;
    }
    public function getAssuranceEtFraisTotalHt(): ?float
    {
        return $this->assuranceEtFraisTotalHt;
    }

    public function setAssuranceEtFraisTotalHt(?float $assuranceEtFraisTotalHt): self
    {
        $this->assuranceEtFraisTotalHt = $assuranceEtFraisTotalHt;

        return $this;
    }

    public function getAssuranceEtFraisTotalHtNormandie(): ?float
    {
        return $this->assuranceEtFraisTotalHtNormandie;
    }

    public function setAssuranceEtFraisTotalHtNormandie(?float $assuranceEtFraisNormandie): self
    {
        $this->assuranceEtFraisTotalHtNormandie = $assuranceEtFraisNormandie;

        return $this;
    }


    public function getTotalPartielTotalHt(): ?float
    {
        return $this->totalPartielTotalHt;
    }

    public function setTotalPartielTotalHt(?float $totalPartielTotalHt): self
    {
        $this->totalPartielTotalHt = $totalPartielTotalHt;

        return $this;
    }

    public function getTotalPartielTotalHtNormandie(): ?float
    {
        return $this->totalPartielTotalHtNormandie;
    }

    public function setTotalPartielTotalHtNormandie(?float $totalPartielTotalHtNormandie): self
    {
        $this->totalPartielTotalHtNormandie = $totalPartielTotalHtNormandie;

        return $this;
    }

    public function getTotalGeneralTotalHt(): ?float
    {
        return $this->totalGeneralTotalHt;
    }
    public function setTotalGeneralTotalHt(?float $totalGeneralTotalHt): self
    {
        $this->totalGeneralTotalHt = $totalGeneralTotalHt;

        return $this;
    }
    public function setTotalGeneralTotalHtNormandie(?float $totalGeneralTotalHtNormandie): self
    {
        $this->totalGeneralTotalHtNormandie = $totalGeneralTotalHtNormandie;

        return $this;
    }

    public function getTotalGeneralTotalHtNormandie(): ?float
    {
        return $this->totalGeneralTotalHtNormandie;
    }

    public function getFinancementAcquis(): ?string
    {
        return $this->financementAcquis;
    }

    public function setFinancementAcquis(string $financementAcquis): self
    {
        $this->financementAcquis = $financementAcquis;

        return $this;
    }

    public function getFinancementAcquisPrecision(): ?string
    {
        return $this->financementAcquisPrecision;
    }

    public function setFinancementAcquisPrecision(string $financementAcquisPrecision): self
    {
        $this->financementAcquisPrecision = $financementAcquisPrecision;

        return $this;
    }


    public function getDepotProjetCollectivite(): ?string
    {
        return $this->depotProjetCollectivite;
    }

    public function setDepotProjetCollectivite(string $depotProjetCollectivite): self
    {
        $this->depotProjetCollectivite = $depotProjetCollectivite;

        return $this;
    }

    public function getDepotProjetCollectivitePrecision(): ?string
    {
        return $this->depotProjetCollectivitePrecision;
    }

    public function setDepotProjetCollectivitePrecision(?string $depotProjetCollectivitePrecision): self
    {
        $this->depotProjetCollectivitePrecision = $depotProjetCollectivitePrecision;

        return $this;
    }

    public function getProjetDejaPresenteFondsAide(): ?string
    {
        return $this->projetDejaPresenteFondsAide;
    }

    public function setProjetDejaPresenteFondsAide(?string $projetDejaPresenteFondsAide): self
    {
        $this->projetDejaPresenteFondsAide = $projetDejaPresenteFondsAide;

        return $this;
    }

    public function getProjetDejaPresenteFondsAideDate(): ?string
    {
        return $this->projetDejaPresenteFondsAideDate;
    }

    public function setProjetDejaPresenteFondsAideDate(?string $projetDejaPresenteFondsAideDate): self
    {
        $this->projetDejaPresenteFondsAideDate = $projetDejaPresenteFondsAideDate;

        return $this;
    }

    public function getProjetDejaPresenteFondsAideTypeAide(): ?string
    {
        return $this->projetDejaPresenteFondsAideTypeAide;
    }

    public function setProjetDejaPresenteFondsAideTypeAide(?string $projetDejaPresenteFondsAideTypeAide): self
    {
        $this->projetDejaPresenteFondsAideTypeAide = $projetDejaPresenteFondsAideTypeAide;

        return $this;
    }

    public function getGenrePrecisionAutre(): ?string
    {
        return $this->genrePrecisionAutre;
    }

    public function setGenrePrecisionAutre(?string $genrePrecisionAutre): self
    {
        $this->genrePrecisionAutre = $genrePrecisionAutre;

        return $this;
    }

    public function getAdaptationOeuvreToa(): ?string
    {
        return $this->adaptationOeuvreToa;
    }

    public function setAdaptationOeuvreToa(?string $adaptationOeuvreToa): self
    {
        $this->adaptationOeuvreToa = $adaptationOeuvreToa;

        return $this;
    }

    public function getAdaptationOeuvreDacp(): ?string
    {
        return $this->adaptationOeuvreDacp;
    }

    public function setAdaptationOeuvreDacp(?string $adaptationOeuvreDacp): self
    {
        $this->adaptationOeuvreDacp = $adaptationOeuvreDacp;

        return $this;
    }

    public function getAdaptationOeuvreDfc(): ?\DateTimeInterface
    {
        return $this->adaptationOeuvreDfc;
    }

    public function setAdaptationOeuvreDfc(?\DateTimeInterface $adaptationOeuvreDfc): self
    {
        $this->adaptationOeuvreDfc = $adaptationOeuvreDfc;

        return $this;
    }

    public function getMontantSollicite(): ?string
    {
        return $this->montantSollicite;
    }

    public function setMontantSollicite(?string $montantSollicite): self
    {
        $this->montantSollicite = $montantSollicite;

        return $this;
    }

    /**
     * @return Collection|Producteur[]
     */
    public function getProducteurs(): Collection
    {
        return $this->producteurs;
    }

    public function addProducteur(Producteur $producteur): self
    {
        if (!$this->producteurs->contains($producteur)) {
            $this->producteurs[] = $producteur;
            $producteur->setProjet($this);
        }

        return $this;
    }

    public function removeProducteur(Producteur $producteur): self
    {
        if ($this->producteurs->contains($producteur)) {
            $this->producteurs->removeElement($producteur);
            // set the owning side to null (unless already changed)
            if ($producteur->getProjet() === $this) {
                $producteur->setProjet(null);
            }
        }

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTypeFilm()
    {
        return $this->typeFilm;
    }

    public function setTypeFilm($typeFilm): self
    {
        $this->typeFilm = $typeFilm;

        return $this;
    }

    public function getTypeOeuvre(): ?string
    {
        return $this->typeOeuvre;
    }

    public function setTypeOeuvre(?string $typeOeuvre): self
    {
        $this->typeOeuvre = $typeOeuvre;

        return $this;
    }

    public function getDureeEpisode(): ?string
    {
        return $this->dureeEpisode;
    }

    public function setDureeEpisode(?string $dureeEpisode): self
    {
        $this->dureeEpisode = $dureeEpisode;

        return $this;
    }

    public function getNomFichierCourrierdemande()
    {
        return $this->nomFichierCourrierdemande;
    }

    public function setNomFichierCourrierdemande( $nomFichierCourrierdemande): self
    {
        $this->nomFichierCourrierdemande = $nomFichierCourrierdemande;

        return $this;
    }
    public function getCourrierdemande()
    {
        return $this->courrierdemande;
    }

    public function setCourrierdemande( $courrierdemande): self
    {
        $this->courrierdemande = $courrierdemande;
        if (null !== $courrierdemande) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtCourrierdemande = new \DateTimeImmutable();
        }
        return $this;
    }
    public function getUpdatedAtCourrierdemande(): ?\DateTimeInterface
    {
        return $this->updatedAtCourrierdemande;
    }

    public function setUpdatedAtCourrierdemande(?\DateTimeInterface $updatedAtCourrierdemande): self
    {
        $this->updatedAtCourrierdemande = $updatedAtCourrierdemande;

        return $this;
    }
  // 2
  public function getNomFichierDossierartistique()
    {
        return $this->nomFichierDossierartistique;
    }

    public function setNomFichierDossierartistique( $nomFichierDossierartistique): self
    {
        $this->nomFichierDossierartistique = $nomFichierDossierartistique;

        return $this;
    }
    public function getDossierartistique()
    {
        return $this->dossierartistique;
    }

    public function setDossierartistique( $dossierartistique): self
    {
        $this->dossierartistique = $dossierartistique;
        if (null !== $dossierartistique) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtDossierartistique = new \DateTimeImmutable();
        }
        return $this;
    }
    public function getUpdatedAtDossierartistique(): ?\DateTimeInterface
    {
        return $this->updatedAtDossierartistique;
    }

    public function setUpdatedAtDossierartistique(?\DateTimeInterface $updatedAtDossierartistique): self
    {
        $this->updatedAtDossierartistique = $updatedAtDossierartistique;

        return $this;
    }

   // 3

   public function getNomFichierDevisPrevisionnel()
   {
       return $this->nomFichierDevisPrevisionnel;
   }

   public function setNomFichierDevisPrevisionnel( $nomFichierDevisPrevisionnel): self
   {
       $this->nomFichierDevisPrevisionnel = $nomFichierDevisPrevisionnel;

       return $this;
   }
   public function getDevisPrevisionnel()
   {
       return $this->devisPrevisionnel;
   }

   public function setDevisPrevisionnel( $devisPrevisionnel): self
   {
       $this->devisPrevisionnel = $devisPrevisionnel;
       if (null !== $devisPrevisionnel) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
           $this->updatedAtDevisPrevisionnel = new \DateTimeImmutable();
       }
       return $this;
   }
   public function getUpdatedAtDevisPrevisionnel(): ?\DateTimeInterface
   {
       return $this->updatedAtDevisPrevisionnel;
   }

   public function setUpdatedAtDevisPrevisionnel(?\DateTimeInterface $updatedAtDevisPresionnel): self
   {
       $this->updatedAtDevisPresionnel = $updatedAtDevisPresionnel;

       return $this;
   }
   // 4
    
   public function getNomFichierPlanFinancement()
   {
       return $this->nomFichierPlanFinancement;
   }

   public function setNomFichierPlanFinancement( $nomFichierPlanFinancement): self
   {
       $this->nomFichierPlanFinancement = $nomFichierPlanFinancement;

       return $this;
   }
   public function getPlanFinancement()
   {
       return $this->planFinancement;
   }

   public function setPlanFinancement( $planFinancement): self
   {
       $this->planFinancement = $planFinancement;
       if (null !== $planFinancement) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
           $this->updatedAtPlanFinancement = new \DateTimeImmutable();
       }
       return $this;
   }
   public function getUpdatedAtPlanFinancement(): ?\DateTimeInterface
   {
       return $this->updatedAtPlanFinancement;
   }

   public function setUpdatedAtPlanFinancement(?\DateTimeInterface $updatedAtPlanFinancement): self
   {
       $this->updatedAtPlanFinancement = $updatedAtPlanFinancement;

       return $this;
   }
   
   // 5
   public function getNomFichierContrat()
   {
       return $this->nomFichierContrat;
   }

   public function setNomFichierContrat( $nomFichierContrat): self
   {
       $this->nomFichierContrat = $nomFichierContrat;

       return $this;
   }
   public function getContrat()
   {
       return $this->contrat;
   }

   public function setContrat( $contrat): self
   {
       $this->contrat = $contrat;
       if (null !== $contrat) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
           $this->updatedAtContrat = new \DateTimeImmutable();
       }
       return $this;
   }
   public function getUpdatedAtContrat(): ?\DateTimeInterface
   {
       return $this->updatedAtContrat;
   }

   public function setUpdatedAtContrat(?\DateTimeInterface $updatedAtContrat): self
   {
       $this->updatedAtContrat = $updatedAtContrat;

       return $this;
   }
  // 6

    public function getNomFichierJustificatifdiffusion()
    {
        return $this->nomFichierJustificatifdiffusion;
    }
    
    public function setNomFichierJustificatifdiffusion( $nomFichierJustificatifdiffusion): self
    {
         $this->nomFichierJustificatifdiffusion = $nomFichierJustificatifdiffusion;
    
         return $this;
     }
     public function getJustificatifdiffusion()
     {
         return $this->justificatifdiffusion;
     }
    
     public function setJustificatifdiffusion( $justificatifdiffusion): self
     {
         $this->justificatifdiffusion = $justificatifdiffusion;
         if (null !== $justificatifdiffusion) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtJustificatifdiffusion = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtJustificatifdiffusion(): ?\DateTimeInterface
     {
         return $this->updatedAtJustificatifdiffusion;
     }
    
     public function setUpdatedAtJustificatifdiffusion(?\DateTimeInterface $updatedAtJustificatifdiffusion): self
     {
         $this->updatedAtJustificatifdiffusion = $updatedAtJustificatifDiffusion;
    
         return $this;
     }
    
    // 7
    public function getNomFichierfinsee()
    {
        return $this->nomFichierfinsee;
    }
    
    public function setNomFichierfinsee( $nomFichierfinsee): self
    {
         $this->nomFichierfinsee = $nomFichierfinsee;
    
         return $this;
     }
     public function getFinsee()
     {
         return $this->finsee;
     }
    
     public function setFinsee( $finsee): self
     {
         $this->finsee = $finsee;
         if (null !== $finsee) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtfinsee = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtfinsee(): ?\DateTimeInterface
     {
         return $this->updatedAtfinsee;
     }
    
     public function setUpdatedAtfinsee(?\DateTimeInterface $updatedAtfinsee): self
     {
         $this->updatedAtfinsee = $updatedAtfinsee;
    
         return $this;
     }
    
    // 8
    public function getNomFichierrib()
    {
        return $this->nomFichierrib;
    }
    
    public function setNomFichierrib( $nomFichierrib): self
    {
         $this->nomFichierrib = $nomFichierrib;
    
         return $this;
     }
     public function getRib()
     {
         return $this->rib;
     }
    
     public function setRib( $rib): self
     {
         $this->rib = $rib;
         if (null !== $rib) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtrib = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtrib(): ?\DateTimeInterface
     {
         return $this->updatedAtrib;
     }
    
     public function setUpdatedAtrib(?\DateTimeInterface $updatedAtrib): self
     {
         $this->updatedAtrib = $updatedAtrib;
    
         return $this;
     }
    
    // 9

     public function getNomFichierengagement()
     {
         return $this->nomFichierengagement;
     }
     
     public function setNomFichierengagement( $nomFichierengagement): self
     {
          $this->nomFichierengagement = $nomFichierengagement;
     
          return $this;
      }
      public function getEngagement()
      {
          return $this->engagement;
      }
     
      public function setEngagement( $engagement): self
      {
          $this->engagement = $engagement;
          if (null !== $engagement) {
              // It is required that at least one field changes if you are using doctrine
              // otherwise the event listeners won't be called and the file is lost
              $this->updatedAtengagement = new \DateTimeImmutable();
          }
          return $this;
      }
      public function getUpdatedAtengagement(): ?\DateTimeInterface
      {
          return $this->updatedAtengagement;
      }
     
      public function setUpdatedAtengagement(?\DateTimeInterface $updatedAtengagement): self
      {
          $this->updatedAtengagement = $updatedAtengagement;
     
          return $this;
      }

      // 10
     
    public function getNomFichierJustificatifeligibilite()
    {
        return $this->nomFichierJustificatifeligibilite;
    }
    
    public function setNomFichierJustificatifeligibilite( $nomFichierJustificatifeligibilite): self
    {
         $this->nomFichierJustificatifeligibilite = $nomFichierJustificatifeligibilite;
    
         return $this;
     }
     public function getJustificatifeligibilite()
     {
         return $this->justificatifeligibilite;
     }
    
     public function setJustificatifeligibilite( $justificatifeligibilite): self
     {
         $this->justificatifeligibilite = $justificatifeligibilite;
         if (null !== $justificatifeligibilite) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtJustificatifeligibilite = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtJustificatifeligibilite(): ?\DateTimeInterface
     {
         return $this->updatedAtJustificatifeligibilite;
     }
    
     public function setUpdatedAtJustificatifeligibilite(?\DateTimeInterface $updatedAtJustificatifeligibilite): self
     {
         $this->updatedAtJustificatifeligibilite = $updatedAtJustificatifeligibilite;
    
         return $this;
     }
    
      // 11
        
    public function getNomFichierDossierpresentation()
    {
        return $this->nomFichierDossierpresentation;
    }
    
    public function setNomFichierDossierpresentation( $nomFichierDossierpresentation): self
    {
         $this->nomFichierDossierpresentation = $nomFichierDossierpresentation;
    
         return $this;
     }
     public function getDossierpresentation()
     {
         return $this->dossierpresentation;
     }
    
     public function setDossierpresentation( $dossierpresentation): self
     {
         $this->dossierpresentation = $dossierpresentation;
         if (null !== $dossierpresentation) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtDossierpresentation = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtDossierpresentation(): ?\DateTimeInterface
     {
         return $this->updatedAtDossierpresentation;
     }
    
     public function setUpdatedAtDossierpresentation(?\DateTimeInterface $updatedAtDossierpresentation): self
     {
         $this->updatedAtDossierpresentation = $updatedAtDossierpresentation;
    
         return $this;
     }
    
     // 12 
     
    public function getNomFichierBudgetprevisionnel()
    {
        return $this->nomFichierBudgetprevisionnel;
    }
    
    public function setNomFichierBudgetprevisionnel( $nomFichierBudgetprevisionnel): self
    {
         $this->nomFichierBudgetprevisionnel = $nomFichierBudgetprevisionnel;
    
         return $this;
     }
     public function getBudgetprevisionnel()
     {
         return $this->budgetprevisionnel;
     }
    
     public function setBudgetprevisionnel( $budgetprevisionnel): self
     {
         $this->budgetprevisionnel = $budgetprevisionnel;
         if (null !== $budgetprevisionnel) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtBudgetprevisionnel = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtBudgetprevisionnel(): ?\DateTimeInterface
     {
         return $this->updatedAtBudgetprevisionnel;
     }
    
     public function setUpdatedAtBudgetprevisionnel(?\DateTimeInterface $updatedAtBudgetprevisionnel): self
     {
         $this->updatedAtBudgetprevisionnel = $updatedAtBudgetprevisionnel;
    
         return $this;
     }
    // 13
    public function getNomFichierDeclarationaide()
    {
        return $this->nomFichierDeclarationaide;
    }
    
    public function setNomFichierDeclarationaide( $nomFichierDeclarationaide): self
    {
         $this->nomFichierDeclarationaide = $nomFichierDeclarationaide;
    
         return $this;
     }
     public function getDeclarationaide()
     {
         return $this->declarationaide;
     }
    
     public function setDeclarationaide( $declarationaide): self
     {
         $this->declarationaide = $declarationaide;
         if (null !== $declarationaide) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtDeclarationaide = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtDeclarationaide(): ?\DateTimeInterface
     {
         return $this->updatedAtDeclarationaide;
     }
    
     public function setUpdatedAtDeclarationaide(?\DateTimeInterface $updatedAtDeclarationaide): self
     {
         $this->updatedAtDeclarationaide = $updatedAtDeclarationaide;
    
         return $this;
     }
    
     // 14 
     
    public function getNomFichierAttestationvigilance()
    {
        return $this->nomFichierAttestationvigilance;
    }
    
    public function setNomFichierAttestationvigilance( $nomFichierAttestationvigilance): self
    {
         $this->nomFichierAttestationvigilance = $nomFichierAttestationvigilance;
    
         return $this;
     }
     public function getAttestationvigilance()
     {
         return $this->attestationvigilance;
     }
    
     public function setAttestationvigilance( $attestationvigilance): self
     {
         $this->attestationvigilance = $attestationvigilance;
         if (null !== $attestationvigilance) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAtAttestationvigilance = new \DateTimeImmutable();
         }
         return $this;
     }
     public function getUpdatedAtAttestationvigilance(): ?\DateTimeInterface
     {
         return $this->updatedAtAttestationvigilance;
     }
    
     public function setUpdatedAtAttestationvigilance(?\DateTimeInterface $updatedAtAttestationvigilance): self
     {
         $this->updatedAtAttestationvigilance = $updatedAtAttestationvigilance;
    
         return $this;
     }

    public function getMotpassehass(): ?string
    {
        return $this->motpassehass;
    }

    public function setMotpassehass(?string $motpassehass): self
    {
        $this->motpassehass = $motpassehass;

        return $this;
    }
    
     // le méthode de l'interface UserInterface
     public function getRoles()
     {
         return ['ROLE_USER'];
     }
     public function getUsername(){
         return $this->randomlogin;
     }
     public function getPassword()
     {
         return $this->motpassehass;
     }
     public function getSalt(){}
     public function eraseCredentials(){}

     public function getMailUtilisateur(): ?string
     {
         return $this->mailUtilisateur;
     }

     public function setMailUtilisateur(string $mailUtilisateur): self
     {
         $this->mailUtilisateur = $mailUtilisateur;

         return $this;
     }

     public function getTokenDate()
     {
         return $this->token_date;
     }

     public function setTokenDate( $token_date): self
     {
         $this->token_date = $token_date;

         return $this;
     }

     public function getDroitArtistiquesFrance(): ?float
     {
         return $this->droitArtistiquesFrance;
     }

     public function setDroitArtistiquesFrance(?float $droitArtistiquesFrance): self
     {
         $this->droitArtistiquesFrance = $droitArtistiquesFrance;

         return $this;
     }

     public function getPersonnelFrance(): ?float
     {
         return $this->personnelFrance;
     }

     public function setPersonnelFrance(?float $personnelFrance): self
     {
         $this->personnelFrance = $personnelFrance;

         return $this;
     }

     public function getInterpretationFrance(): ?float
     {
         return $this->interpretationFrance;
     }

     public function setInterpretationFrance(?float $interpretationFrance): self
     {
         $this->interpretationFrance = $interpretationFrance;

         return $this;
     }

     public function getChargeSocialeFrance(): ?float
     {
         return $this->chargeSocialeFrance;
     }

     public function setChargeSocialeFrance(?float $chargeSocialeFrance): self
     {
         $this->chargeSocialeFrance = $chargeSocialeFrance;

         return $this;
     }

     public function getDecoEtCostumesFrance(): ?float
     {
         return $this->decoEtCostumesFrance;
     }

     public function setDecoEtCostumesFrance(?float $decoEtCostumesFrance): self
     {
         $this->decoEtCostumesFrance = $decoEtCostumesFrance;

         return $this;
     }

     public function getTransportFrance(): ?float
     {
         return $this->transportFrance;
     }

     public function setTransportFrance(?float $transportFrance): self
     {
         $this->transportFrance = $transportFrance;

         return $this;
     }

     public function getMoyenTechniqueFrance(): ?float
     {
         return $this->moyenTechniqueFrance;
     }

     public function setMoyenTechniqueFrance(?float $moyenTechniqueFrance): self
     {
         $this->moyenTechniqueFrance = $moyenTechniqueFrance;

         return $this;
     }

     public function getPelliculesFrance(): ?float
     {
         return $this->pelliculesFrance;
     }

     public function setPelliculesFrance(?float $pelliculesFrance): self
     {
         $this->pelliculesFrance = $pelliculesFrance;

         return $this;
     }

     public function getAssuranceFrance(): ?float
     {
         return $this->assuranceFrance;
     }

     public function setAssuranceFrance(?float $assuranceFrance): self
     {
         $this->assuranceFrance = $assuranceFrance;

         return $this;
     }

     

     public function getTotalPartielFrance(): ?float
     {
         return $this->totalPartielFrance;
     }

     public function setTotalPartielFrance(?float $totalPartielFrance): self
     {
         $this->totalPartielFrance = $totalPartielFrance;

         return $this;
     }

     public function getTotalGeneralFrance(): ?float
     {
         return $this->totalGeneralFrance;
     }

     public function setTotalGeneralFrance(?float $totalGeneralFrance): self
     {
         $this->totalGeneralFrance = $totalGeneralFrance;

         return $this;
     }

     public function getProductionTv(): ?string
     {
         return $this->productionTv;
     }

     public function setProductionTv(?string $productionTv): self
     {
         $this->productionTv = $productionTv;

         return $this;
     }

     public function getPreachatTv(): ?string
     {
         return $this->preachatTv;
     }

     public function setPreachatTv(?string $preachatTv): self
     {
         $this->preachatTv = $preachatTv;

         return $this;
     }

     public function getNombreEpisode(): ?string
     {
         return $this->nombreEpisode;
     }

     public function setNombreEpisode(?string $nombreEpisode): self
     {
         $this->nombreEpisode = $nombreEpisode;

         return $this;
     }

     public function getValiderEtTransmettreCandidature()
     {
         return $this->validerEtTransmettreCandidature;
     }

     public function setValiderEtTransmettreCandidature( $validerEtTransmettreCandidature): self
     {
         $this->validerEtTransmettreCandidature = $validerEtTransmettreCandidature;

         return $this;
     }

     public function getPremierFilm(): ?array
     {
         return $this->premierFilm;
     }

     public function setPremierFilm(?array $premierFilm): self
     {
         $this->premierFilm = $premierFilm;

         return $this;
     }

     public function getDroitArtistiqueCoutDefinitif(): ?float
     {
         return $this->droitArtistiqueCoutDefinitif;
     }

     public function setDroitArtistiqueCoutDefinitif(?float $droitArtistiqueCoutDefinitif): self
     {
         $this->droitArtistiqueCoutDefinitif = $droitArtistiqueCoutDefinitif;

         return $this;
     }

     public function getPersonnelCoutDefinitif(): ?float
     {
         return $this->personnelCoutDefinitif;
     }

     public function setPersonnelCoutDefinitif(?float $personnelCoutDefinitif): self
     {
         $this->personnelCoutDefinitif = $personnelCoutDefinitif;

         return $this;
     }

     public function getInterpretationCoutDefinitif(): ?float
     {
         return $this->interpretationCoutDefinitif;
     }

     public function setInterpretationCoutDefinitif(?float $interpretationCoutDefinitif): self
     {
         $this->interpretationCoutDefinitif = $interpretationCoutDefinitif;

         return $this;
     }

     public function getTotalChargeSocialesCoutDefinitif(): ?float
     {
         return $this->totalChargeSocialesCoutDefinitif;
     }

     public function setTotalChargeSocialesCoutDefinitif(?float $totalChargeSocialesCoutDefinitif): self
     {
         $this->totalChargeSocialesCoutDefinitif = $totalChargesSocialeCoutDefinitif;

         return $this;
     }

     public function getDecoEtCostumesCoutDefinitif(): ?float
     {
         return $this->decoEtCostumesCoutDefinitif;
     }

     public function setDecoEtCostumesCoutDefinitif(?float $decoEtCostumesCoutDefinitif): self
     {
         $this->decoEtCostumesCoutDefinitif = $decoEtCostumesCoutDefinitif;

         return $this;
     }

     public function getTransportCoutDefinitif(): ?float
     {
         return $this->transportCoutDefinitif;
     }

     public function setTransportCoutDefinitif(?float $transportCoutDefinitif): self
     {
         $this->transportCoutDefinitif = $transportCoutDefinitif;

         return $this;
     }

     public function getMoyenTechniqueCoutDefinitif(): ?float
     {
         return $this->moyenTechniqueCoutDefinitif;
     }

     public function setMoyenTechniqueCoutDefinitif(?float $moyenTechniqueCoutDefinitif): self
     {
         $this->moyenTechniqueCoutDefinitif = $moyenTechniqueCoutDefinitif;

         return $this;
     }

     public function getPelliculesCoutDefinitif(): ?float
     {
         return $this->pelliculesCoutDefinitif;
     }

     public function setPelliculesCoutDefinitif(?float $pelliculesCoutDefinitif): self
     {
         $this->pelliculesCoutDefinitif = $pelliculesCoutDefinitif;

         return $this;
     }

     public function getAssuranceEtFraisCoutDefinitif(): ?float
     {
         return $this->assuranceEtFraisCoutDefinitif;
     }

     public function setAssuranceEtFraisCoutDefinitif(?float $assuranceEtFraisCoutDefinitif): self
     {
         $this->assuranceEtFraisCoutDefinitif = $assuranceEtFraisCoutDefinitif;

         return $this;
     }

     public function getTotalPartielCoutDefinitif(): ?float
     {
         return $this->totalPartielCoutDefinitif;
     }

     public function setTotalPartielCoutDefinitif(?float $totalPartielCoutDefinitif): self
     {
         $this->totalPartielCoutDefinitif = $totalPartielCoutDefinitif;

         return $this;
     }

     public function getFraisGenerauxCoutDefinitif(): ?float
     {
         return $this->fraisGenerauxCoutDefinitif;
     }

     public function setFraisGenerauxCoutDefinitif(?float $fraisGenerauxCoutDefinitif): self
     {
         $this->fraisGenerauxCoutDefinitif = $fraisGenerauxCoutDefinitif;

         return $this;
     }

     public function getImprevusCoutDefinitif(): ?float
     {
         return $this->imprevusCoutDefinitif;
     }

     public function setImprevusCoutDefinitif(?float $imprevusCoutDefinitif): self
     {
         $this->imprevusCoutDefinitif = $imprevusCoutDefinitif;

         return $this;
     }

     public function getTotalGeneralCoutDefinitif(): ?float
     {
         return $this->totalGeneralCoutDefinitif;
     }

     public function setTotalGeneralCoutDefinitif(?float $totalGeneralCoutDefinitif): self
     {
         $this->totalGeneralCoutDefinitif = $totalGeneralCoutDefinitif;

         return $this;
     }

     public function getFraisGenerauxTotalHT(): ?float
     {
         return $this->fraisGenerauxTotalHT;
     }

     public function setFraisGenerauxTotalHT(?float $fraisGenerauxTotalHT): self
     {
         $this->fraisGenerauxTotalHT = $fraisGenerauxTotalHT;

         return $this;
     }

     public function getFraisGenerauxDepenseFrance(): ?float
     {
         return $this->fraisGenerauxDepenseFrance;
     }

     public function setFraisGenerauxDepenseFrance(?float $fraisGenerauxDepenseFrance): self
     {
         $this->fraisGenerauxDepenseFrance = $fraisGenerauxDepenseFrance;

         return $this;
     }

     public function getFraisGenerauxNormandie(): ?float
     {
         return $this->fraisGenerauxNormandie;
     }

     public function setFraisGenerauxNormandie(float $fraisGenerauxNormandie): self
     {
         $this->fraisGenerauxNormandie = $fraisGenerauxNormandie;

         return $this;
     }

     public function getImprevusDepenseFrance(): ?float
     {
         return $this->imprevusDepenseFrance;
     }

     public function setImprevusDepenseFrance(?float $imprevusDepenseFrance): self
     {
         $this->imprevusDepenseFrance = $imprevusDepenseFrance;

         return $this;
     }

     public function getImprevusNormandie(): ?float
     {
         return $this->imprevusNormandie;
     }

     public function setImprevusNormandie(?float $imprevusNormandie): self
     {
         $this->imprevusNormandie = $imprevusNormandie;

         return $this;
     }

     public function getImprevusTotalHT(): ?float
     {
         return $this->imprevusTotalHT;
     }

     public function setImprevusTotalHT(?float $imprevusTotalHT): self
     {
         $this->imprevusTotalHT = $imprevusTotalHT;

         return $this;
     }

     public function getNombreSalariePermanent(): ?int
     {
         return $this->nombreSalariePermanent;
     }

     public function setNombreSalariePermanent(?int $nombreSalariePermanent): self
     {
         $this->nombreSalariePermanent = $nombreSalariePermanent;

         return $this;
     }

     public function getNombreSalarieIntermittent(): ?int
     {
         return $this->nombreSalarieIntermittent;
     }

     public function setNombreSalarieIntermittent(?int $nombreSalarieIntermittent): self
     {
         $this->nombreSalarieIntermittent = $nombreSalarieIntermittent;

         return $this;
     }

     public function getSalariePermenentEqtemps(): ?int
     {
         return $this->salariePermenentEqtemps;
     }

     public function setSalariePermenentEqtemps(?int $salariePermenentEqtemps): self
     {
         $this->salariePermenentEqtemps = $salariePermenentEqtemps;

         return $this;
     }

     public function getSalarieIntermittentth(): ?string
     {
         return $this->salarieIntermittentth;
     }

     public function setSalarieIntermittentth(?string $salarieIntermittentth): self
     {
         $this->salarieIntermittentth = $salarieIntermittentth;

         return $this;
     }

     /**
      * @return Collection|ProjetPresente[]
      */
     public function getProjetPresentes(): Collection
     {
         return $this->projetPresentes;
     }

     public function addProjetPresente(ProjetPresente $projetPresente): self
     {
         if (!$this->projetPresentes->contains($projetPresente)) {
             $this->projetPresentes[] = $projetPresente;
             $projetPresente->setProjet($this);
         }

         return $this;
     }

     public function removeProjetPresente(ProjetPresente $projetPresente): self
     {
         if ($this->projetPresentes->contains($projetPresente)) {
             $this->projetPresentes->removeElement($projetPresente);
             // set the owning side to null (unless already changed)
             if ($projetPresente->getProjet() === $this) {
                 $projetPresente->setProjet(null);
             }
         }

         return $this;
     }

     public function getMtTotalProgrammeDeveloppement(): ?string
     {
         return $this->mtTotalProgrammeDeveloppement;
     }

     public function setMtTotalProgrammeDeveloppement(?string $mtTotalProgrammeDeveloppement): self
     {
         $this->mtTotalProgrammeDeveloppement = $mtTotalProgrammeDeveloppement;

         return $this;
     }

     public function getWhoIsSubmitted(): ?string
     {
         return $this->whoIsSubmitted;
     }

     public function setWhoIsSubmitted(?string $whoIsSubmitted): self
     {
         $this->whoIsSubmitted = $whoIsSubmitted;

         return $this;
     }

     public function getStatus(): ?string
     {
         return $this->status;
     }

     public function setStatus(?string $status): self
     {
         $this->status = $status;

         return $this;
     }
 
}
