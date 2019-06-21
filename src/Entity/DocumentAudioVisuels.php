<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentAudioVisuelsRepository")
 */
class DocumentAudioVisuels
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
 
    /**
     * @ORM\Column(type="string", length=255, nullable=true)

     * @Assert\Length(max=250, maxMessage="Le titre ne doit pas dépasser 250 caractères")
     */
    
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\Length(max=250, maxMessage="Le realisateur ne doit pas dépasser 250 caractères")
     */
    private $realisateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\Length(max=250, maxMessage="Le genre ne doit pas dépasser 250 caractères")
     */
    private $genre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=250, maxMessage="Le mot de passe ne doit pas dépasser 250 caractères")
     */
    private $motDePasse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="documentAudioVisuels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="l'url {{ value }} n'est pas valide")
     */
    private $lien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function setRealisateur($realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre( $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse( $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

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

    public function getLien()
    {
        return $this->lien;
    }

    public function setLien( $lien): self
    {
        $this->lien = $lien;

        return $this;
    }
}
