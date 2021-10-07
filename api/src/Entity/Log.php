<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $info_entree;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="logs")
     */
    private $aura_un;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfoEntree(): ?\DateTimeInterface
    {
        return $this->info_entree;
    }

    public function setInfoEntree(\DateTimeInterface $info_entree): self
    {
        $this->info_entree = $info_entree;

        return $this;
    }

    public function getAuraUn(): ?Profil
    {
        return $this->aura_un;
    }

    public function setAuraUn(?Profil $aura_un): self
    {
        $this->aura_un = $aura_un;

        return $this;
    }
}
