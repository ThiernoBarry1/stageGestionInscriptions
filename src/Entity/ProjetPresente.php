<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetPresenteRepository")
 */
class ProjetPresente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteurrealisateur;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $dureeEnvisagee;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $coutPrevisionnel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="projetPresentes")
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $precisionAutre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteurrealisateur(): ?string
    {
        return $this->auteurrealisateur;
    }

    public function setAuteurrealisateur(?string $auteurrealisateur): self
    {
        $this->auteurrealisateur = $auteurrealisateur;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDureeEnvisagee(): ?string
    {
        return $this->dureeEnvisagee;
    }

    public function setDureeEnvisagee(?string $dureeEnvisagee): self
    {
        $this->dureeEnvisagee = $dureeEnvisagee;

        return $this;
    }

    public function getCoutPrevisionnel(): ?string
    {
        return $this->coutPrevisionnel;
    }

    public function setCoutPrevisionnel(?string $coutPrevisionnel): self
    {
        $this->coutPrevisionnel = $coutPrevisionnel;

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

    public function getPrecisionAutre(): ?string
    {
        return $this->precisionAutre;
    }

    public function setPrecisionAutre(?string $precisionAutre): self
    {
        $this->precisionAutre = $precisionAutre;

        return $this;
    }
}
