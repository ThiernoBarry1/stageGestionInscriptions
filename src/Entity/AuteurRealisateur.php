<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRealisateurRepository")
 */
class AuteurRealisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $pseudonyme;

    /**
     * @ORM\Column(type="string", length=60,nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=6,nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephoneMobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $courriel;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $typePersonne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="auteurRealisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pourcentageAuteurRealisateur;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudonyme(): ?string
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme(?string $pseudonyme): self
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephoneMobile(): ?string
    {
        return $this->telephoneMobile;
    }

    public function setTelephoneMobile(string $telephoneMobile): self
    {
        $this->telephoneMobile = $telephoneMobile;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): self
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getTypePersonne(): ?string
    {
        return $this->typePersonne;
    }

    public function setTypePersonne(string $typePersonne): self
    {
        $this->typePersonne = $typePersonne;

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

    public function getPourcentageAuteurRealisateur(): ?string
    {
        return $this->pourcentageAuteurRealisateur;
    }

    public function setPourcentageAuteurRealisateur(?string $pourcentageAuteurRealisateur): self
    {
        $this->pourcentageAuteurRealisateur = $pourcentageAuteurRealisateur;

        return $this;
    }
}
