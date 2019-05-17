<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $preselection;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $pleniere;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numerusClausus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FondsAide", inversedBy="sessions")
     */
    private $fondsAide;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="session")
     */
    private $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPreselection(): ?\DateTimeInterface
    {
        return $this->preselection;
    }

    public function setPreselection(\DateTimeInterface $preselection): self
    {
        $this->preselection = $preselection;

        return $this;
    }

    public function getPleniere(): ?\DateTimeInterface
    {
        return $this->pleniere;
    }

    public function setPleniere(\DateTimeInterface $pleniere): self
    {
        $this->pleniere = $pleniere;

        return $this;
    }

    public function getNumerusClausus(): ?int
    {
        return $this->numerusClausus;
    }

    public function setNumerusClausus(?int $numerusClausus): self
    {
        $this->numerusClausus = $numerusClausus;

        return $this;
    }

    public function getFondsAide(): ?FondsAide
    {
        return $this->fondsAide;
    }

    public function setFondsAide(?FondsAide $fondsAide): self
    {
        $this->fondsAide = $fondsAide;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setSession($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getSession() === $this) {
                $projet->setSession(null);
            }
        }

        return $this;
    }
}
