<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfilRepository")
 */
class Profil
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
    private $profil_lib;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\profil", inversedBy="profils")
     */
    private $profilParent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agence", inversedBy="profils")
     */
    private $agences;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeAnomalies", inversedBy="profils")
     */
    private $list_type_anomalies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="profil")
     */
    private $users;

    public function __construct()
    {
        $this->agences = new ArrayCollection();
        $this->list_type_anomalies = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfilLib(): ?string
    {
        return $this->profil_lib;
    }

    public function setProfilLib(string $profil_lib): self
    {
        $this->profil_lib = $profil_lib;

        return $this;
    }

    public function getProfilParent(): ?profil
    {
        return $this->profilParent;
    }

    public function setProfilParent(?profil $profilParent): self
    {
        $this->profilParent = $profilParent;

        return $this;
    }

    /**
     * @return Collection|Agence[]
     */
    public function getAgences(): Collection
    {
        return $this->agences;
    }

    public function addAgence(Agence $agence): self
    {
        if (!$this->agences->contains($agence)) {
            $this->agences[] = $agence;
        }

        return $this;
    }

    public function removeAgence(Agence $agence): self
    {
        if ($this->agences->contains($agence)) {
            $this->agences->removeElement($agence);
        }

        return $this;
    }

    /**
     * @return Collection|TypeAnomalies[]
     */
    public function getListTypeAnomalies(): Collection
    {
        return $this->list_type_anomalies;
    }

    public function addListTypeAnomalies(TypeAnomalies $ListTypeAnomalies): self
    {
        if (!$this->list_type_anomalies->contains($ListTypeAnomalies)) {
            $this->list_type_anomalies[] = $ListTypeAnomalies;
        }

        return $this;
    }

    public function removeListTypeAnomalies(TypeAnomalies $ListTypeAnomalies): self
    {
        if ($this->list_type_anomalies->contains($ListTypeAnomalies)) {
            $this->list_type_anomalies->removeElement($ListTypeAnomalies);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }
}
