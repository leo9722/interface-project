<?php

namespace App\Entity;

use App\Repository\JoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoursRepository::class)
 */
class Jours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jours;

    /**
     * @ORM\ManyToMany(targetEntity=GestionHeure::class, inversedBy="jours")
     */
    private $peut_se_relier_a;

    public function __construct()
    {
        $this->peut_se_relier_a = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJours(): ?string
    {
        return $this->jours;
    }

    public function setJours(string $jours): self
    {
        $this->jours = $jours;

        return $this;
    }

    /**
     * @return Collection|GestionHeure[]
     */
    public function getPeutSeRelierA(): Collection
    {
        return $this->peut_se_relier_a;
    }

    public function addPeutSeRelierA(GestionHeure $peutSeRelierA): self
    {
        if (!$this->peut_se_relier_a->contains($peutSeRelierA)) {
            $this->peut_se_relier_a[] = $peutSeRelierA;
        }

        return $this;
    }

    public function removePeutSeRelierA(GestionHeure $peutSeRelierA): self
    {
        $this->peut_se_relier_a->removeElement($peutSeRelierA);

        return $this;
    }
}
