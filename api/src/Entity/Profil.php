<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
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
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url_photo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invite;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="peut_avoir")
     */
    private $utilisateurs;

    /**
     * @ORM\OneToMany(targetEntity=Log::class, mappedBy="aura_un")
     */
    private $logs;

    /**
     * @ORM\ManyToMany(targetEntity=GestionHeure::class, mappedBy="est_relie_a")
     */
    private $gestionHeures;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
        $this->gestionHeures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
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

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(string $url_photo): self
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    public function getInvite(): ?bool
    {
        return $this->invite;
    }

    public function setInvite(bool $invite): self
    {
        $this->invite = $invite;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }

    /**
     * @return Collection|Log[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setAuraUn($this);
        }

        return $this;
    }

    public function removeLog(Log $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getAuraUn() === $this) {
                $log->setAuraUn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestionHeure[]
     */
    public function getGestionHeures(): Collection
    {
        return $this->gestionHeures;
    }

    public function addGestionHeure(GestionHeure $gestionHeure): self
    {
        if (!$this->gestionHeures->contains($gestionHeure)) {
            $this->gestionHeures[] = $gestionHeure;
            $gestionHeure->addEstRelieA($this);
        }

        return $this;
    }

    public function removeGestionHeure(GestionHeure $gestionHeure): self
    {
        if ($this->gestionHeures->removeElement($gestionHeure)) {
            $gestionHeure->removeEstRelieA($this);
        }

        return $this;
    }
}
