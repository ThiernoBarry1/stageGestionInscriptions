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
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères pour le titre")
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $formatTournage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir mois de 255 caractères")
     */
    private $formatDefinitif;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20,maxMessage="Merci de saisir mois de 20 caractères")
     */
    private $genre;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=600,maxMessage="le synopsis ne dois pas dépasser {{ value }} caractères")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $adaptationOeuvre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
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
     * * @Assert\Length(max=20,maxMessage="Merci de saisir mois de 20 caractères")
     */
    private $typeAideDoc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mtBudget;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $liensEligibilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $datePreparation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateTournage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $financementAcquis;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $financementAcquisPrecision;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $depotProjetCollectivite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $depotProjetCollectivitePrecision;

    /**
     * @ORM\Column(type="boolean", nullable=true)
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
     * @Assert\DateTime(message="Cette date n'est pas une date valide")
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=25,nullable=true)
     * @Assert\Length(max=255,maxMessage="Merci de saisir moins de 255 caractères")
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
     *@Vich\UploadableField(mapping="documents", fileNameProperty="nomFichier")
     * @Assert\File(mimeTypes="application/pdf",mimeTypesMessage="uniquement les documents pdf sont autorisé")
     * @var File|null
     */
    private $file;
    /**
     * @var  string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le nom du fichier est trop long")
     */
    private $nomFichier;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="Le mot de pass ne doit pas dépasser 255 caractères")
     */
    private $motpassehass;

    /**
     * @ORM\Column(type="string", length=255)
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
     */
    private $productionTv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $preachatTv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreEpisode;

    

    public function __construct()
    {
        $this->auteurRealisateurs = new ArrayCollection();
        $this->documentAudioVisuels = new ArrayCollection();
        $this->producteurs = new ArrayCollection();
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

    public function getAdaptationOeuvre(): ?bool
    {
        return $this->adaptationOeuvre;
    }

    public function setAdaptationOeuvre(bool $adaptationOeuvre): self
    {
        $this->adaptationOeuvre = $adaptationOeuvre;

        return $this;
    }

    public function getDeposant(): ?bool
    {
        return $this->deposant;
    }

    public function setDeposant(bool $deposant): self
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

    public function getFinancementAcquis(): ?bool
    {
        return $this->financementAcquis;
    }

    public function setFinancementAcquis(bool $financementAcquis): self
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


    public function getDepotProjetCollectivite(): ?bool
    {
        return $this->depotProjetCollectivite;
    }

    public function setDepotProjetCollectivite(bool $depotProjetCollectivite): self
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

    public function getProjetDejaPresenteFondsAide(): ?bool
    {
        return $this->projetDejaPresenteFondsAide;
    }

    public function setProjetDejaPresenteFondsAide(?bool $projetDejaPresenteFondsAide): self
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

    public function getNomFichier()
    {
        return $this->nomFichier;
    }

    public function setNomFichier( $nomFichier): self
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }
    public function getFile()
    {
        return $this->file;
    }

    public function setFile( $file): self
    {
        $this->file = $file;
        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
 
}
