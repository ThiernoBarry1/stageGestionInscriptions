<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProducteurRepository")
 */
class Producteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $nature;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     * @Assert\Length(max=15,minMessage="Le numéro doit avoir 14 chiffres",maxMessage="Le numéro doit avoir 14 chiffres")
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50,maxMessage="Le nom du gérant ne doit pas dépasser 50 caractères")
     */
    private $nomGerant;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100, maxMessage="Le prénom du gérant ne doit pas dépasser 100 caractères")
     */
    private $prenomGerant;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50, maxMessage="Le nom du producteur ne doit pas dépasser 50 caractères")
     */
    private $nomProducteur;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100, maxMessage="Le prénom du producteur ne doit pas dépasser 100 caractères")
     */
    private $prenomProducteur;

    
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Length(max=60,maxMessage="L'adresse ne doit pas dépasser plus de 60 caractères")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Assert\Length(min=4,max=6,minMessage=" Le code postal doit comporter 4 caractères",maxMessage=" Le code postal doit comporter 4 caractères")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50,maxMessage="Le nom de la ville ne doit pas dépasser 50 caratères")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Length(max=60,maxMessage="L'adresse ne doit pas dépasser plus de 60 caractères")
     */
    private $adresseBureau;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     *  @Assert\Length(min=4,max=6,minMessage=" Le code postal doit comporter 4 caractères",maxMessage=" Le code postal doit comporter 4 caractères")
     */
    private $codePostaleBureau;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Length(max=60,maxMessage="Le nom de la ville ne doit pas dépasser 60 caratères")
     */
    private $villeBureau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="producteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100, maxMessage="Le prénom ne doit pas dépasser 100 caractères")
     */
    private $prenomPersonneChargee;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50, maxMessage="Le nom ne doit pas dépasser 50 caractères")
     */
    private $nomPersonneChargee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $telephoneMobilePersonneChargee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $telephoneFixePersonneChargee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="L'adresse mail que vous avez indiqué n'est pas valide")
     */
    private $courrielPersonneChargee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $telephoneMobileProducteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $telephoneFixeProducteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="L'adresse mail que vous avez indiqué n'est pas valide")
     */
    private $courrielProducteur;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNomGerant(): ?string
    {
        return $this->nomGerant;
    }

    public function setNomGerant(?string $nomGerant): self
    {
        $this->nomGerant = $nomGerant;

        return $this;
    }

    public function getPrenomGerant(): ?string
    {
        return $this->prenomGerant;
    }

    public function setPrenomGerant(?string $prenomGerant): self
    {
        $this->prenomGerant = $prenomGerant;

        return $this;
    }

    public function getNomProducteur(): ?string
    {
        return $this->nomProducteur;
    }

    public function setNomProducteur(?string $nomProducteur): self
    {
        $this->nomProducteur = $nomProducteur;

        return $this;
    }

    public function getPrenomProducteur(): ?string
    {
        return $this->prenomProducteur;
    }

    public function setPrenomProducteur(?string $prenomProducteur): self
    {
        $this->prenomProducteur = $prenomProducteur;

        return $this;
    }


    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresseBureau(): ?string
    {
        return $this->adresseBureau;
    }

    public function setAdresseBureau(?string $adresseBureau): self
    {
        $this->adresseBureau = $adresseBureau;

        return $this;
    }

    public function getCodePostaleBureau(): ?string
    {
        return $this->codePostaleBureau;
    }

    public function setCodePostaleBureau(?string $codePostaleBureau): self
    {
        $this->codePostaleBureau = $codePostaleBureau;

        return $this;
    }

    public function getVilleBureau(): ?string
    {
        return $this->villeBureau;
    }

    public function setVilleBureau(?string $villeBureau): self
    {
        $this->villeBureau = $villeBureau;

        return $this;
    }

   
    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getPrenomPersonneChargee(): ?string
    {
        return $this->prenomPersonneChargee;
    }

    public function setPrenomPersonneChargee(?string $prenomPersonneChargee): self
    {
        $this->prenomPersonneChargee = $prenomPersonneChargee;

        return $this;
    }

    public function getNomPersonneChargee(): ?string
    {
        return $this->nomPersonneChargee;
    }

    public function setNomPersonneChargee(?string $nomPersonneChargee): self
    {
        $this->nomPersonneChargee = $nomPersonneChargee;

        return $this;
    }

    public function getTelephoneMobilePersonneChargee(): ?string
    {
        return $this->telephoneMobilePersonneChargee;
    }

    public function setTelephoneMobilePersonneChargee(?string $telephoneMobilePersonneChargee): self
    {
        $this->telephoneMobilePersonneChargee = $telephoneMobilePersonneChargee;

        return $this;
    }

    public function getTelephoneFixePersonneChargee(): ?string
    {
        return $this->telephoneFixePersonneChargee;
    }

    public function setTelephoneFixePersonneChargee(?string $telephoneFixePersonneChargee): self
    {
        $this->telephoneFixePersonneChargee = $telephoneFixePersonneChargee;

        return $this;
    }

    public function getCourrielPersonneChargee(): ?string
    {
        return $this->courrielPersonneChargee;
    }

    public function setCourrielPersonneChargee(?string $courrielPersonneChargee): self
    {
        $this->courrielPersonneChargee = $courrielPersonneChargee;

        return $this;
    }

    public function getTelephoneMobileProducteur(): ?string
    {
        return $this->telephoneMobileProducteur;
    }

    public function setTelephoneMobileProducteur(?string $telephoneMobileProducteur): self
    {
        $this->telephoneMobileProducteur = $telephoneMobileProducteur;

        return $this;
    }

    public function getTelephoneFixeProducteur(): ?string
    {
        return $this->telephoneFixeProducteur;
    }

    public function setTelephoneFixeProducteur(?string $telephoneFixeProducteur): self
    {
        $this->telephoneFixeProducteur = $telephoneFixeProducteur;

        return $this;
    }

    public function getCourrielProducteur(): ?string
    {
        return $this->courrielProducteur;
    }

    public function setCourrielProducteur(?string $courrielProducteur): self
    {
        $this->courrielProducteur = $courrielProducteur;

        return $this;
    }
  
}
