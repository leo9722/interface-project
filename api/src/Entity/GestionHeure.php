<?php

namespace App\Entity;

use App\Repository\GestionHeureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionHeureRepository::class)
 */
class GestionHeure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_entree;

    /**
     * @ORM\Column(type="date")
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Jours::class, mappedBy="peut_se_relier_a")
     */
    private $jours;

    /**
     * @ORM\ManyToOne(targetEntity=PlageHoraire::class, inversedBy="se_situe_sur")
     */
    private $plageHoraire;

    /**
     * @ORM\ManyToMany(targetEntity=Profil::class, inversedBy="gestionHeures")
     */
    private $est_relie_a;

    public function __construct()
    {
        $this->jours = new ArrayCollection();
        $this->est_relie_a = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $date_entree): self
    {
        $this->date_entree = $date_entree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Jours[]
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jours $jour): self
    {
        if (!$this->jours->contains($jour)) {
            $this->jours[] = $jour;
            $jour->addPeutSeRelierA($this);
        }

        return $this;
    }

    public function removeJour(Jours $jour): self
    {
        if ($this->jours->removeElement($jour)) {
            $jour->removePeutSeRelierA($this);
        }

        return $this;
    }

    public function getPlageHoraire(): ?PlageHoraire
    {
        return $this->plageHoraire;
    }

    public function setPlageHoraire(?PlageHoraire $plageHoraire): self
    {
        $this->plageHoraire = $plageHoraire;

        return $this;
    }

    /**
     * @return Collection|Profil[]
     */
    public function getEstRelieA(): Collection
    {
        return $this->est_relie_a;
    }

    public function addEstRelieA(Profil $estRelieA): self
    {
        if (!$this->est_relie_a->contains($estRelieA)) {
            $this->est_relie_a[] = $estRelieA;
        }

        return $this;
    }

    public function removeEstRelieA(Profil $estRelieA): self
    {
        $this->est_relie_a->removeElement($estRelieA);

        return $this;
    }
}
