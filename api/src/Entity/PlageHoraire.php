<?php

namespace App\Entity;

use App\Repository\PlageHoraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlageHoraireRepository::class)
 */
class PlageHoraire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_entree;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_sortie;

    /**
     * @ORM\OneToMany(targetEntity=GestionHeure::class, mappedBy="plageHoraire")
     */
    private $se_situe_sur;

    public function __construct()
    {
        $this->se_situe_sur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureEntree(): ?\DateTimeInterface
    {
        return $this->heure_entree;
    }

    public function setHeureEntree(\DateTimeInterface $heure_entree): self
    {
        $this->heure_entree = $heure_entree;

        return $this;
    }

    public function getHeureSortie(): ?\DateTimeInterface
    {
        return $this->heure_sortie;
    }

    public function setHeureSortie(\DateTimeInterface $heure_sortie): self
    {
        $this->heure_sortie = $heure_sortie;

        return $this;
    }

    /**
     * @return Collection|GestionHeure[]
     */
    public function getSeSitueSur(): Collection
    {
        return $this->se_situe_sur;
    }

    public function addSeSitueSur(GestionHeure $seSitueSur): self
    {
        if (!$this->se_situe_sur->contains($seSitueSur)) {
            $this->se_situe_sur[] = $seSitueSur;
            $seSitueSur->setPlageHoraire($this);
        }

        return $this;
    }

    public function removeSeSitueSur(GestionHeure $seSitueSur): self
    {
        if ($this->se_situe_sur->removeElement($seSitueSur)) {
            // set the owning side to null (unless already changed)
            if ($seSitueSur->getPlageHoraire() === $this) {
                $seSitueSur->setPlageHoraire(null);
            }
        }

        return $this;
    }
}
