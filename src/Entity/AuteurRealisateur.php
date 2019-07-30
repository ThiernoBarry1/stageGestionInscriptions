<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50,maxMessage="merci de saisir moins de 50 caractères")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100,maxMessage="merci de saisir moins de 100 caractères")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Length(max=150,maxMessage="merci de saisir moins de 150 caractères")
     */
    private $pseudonyme;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Length(max=60,maxMessage="merci de saisir moins de 60 caractères")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Assert\Length(max=5,maxMessage="merci de saisir moins de 5 caractères")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50,maxMessage="merci de saisir moins de 50 caractères")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $telephoneMobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="l'adresse mail que vous avez indiqué n'est pas valide")
     */
    private $courriel;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $typePersonne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet",inversedBy="auteurRealisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=255,maxMessage="merci de saisir moins de 255 caractères")
     */
    private $pourcentageAuteurRealisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudonyme()
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme( $pseudonyme): self
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse( $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal( $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephoneMobile()
    {
        return $this->telephoneMobile;
    }

    public function setTelephoneMobile( $telephoneMobile): self
    {
        $this->telephoneMobile = $telephoneMobile;

        return $this;
    }

    public function getCourriel()
    {
        return $this->courriel;
    }

    public function setCourriel($courriel): self
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getTypePersonne()
    {
        return $this->typePersonne;
    }

    public function setTypePersonne($typePersonne): self
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
