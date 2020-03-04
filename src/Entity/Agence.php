<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgenceRepository")
 */
class Agence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $agence_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agence_lib;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Direction", inversedBy="agences")
     */
    private $direction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profil", mappedBy="agences")
     */
    private $profils;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgenceCode(): ?string
    {
        return $this->agence_code;
    }

    public function setAgenceCode(string $agence_code): self
    {
        $this->agence_code = $agence_code;

        return $this;
    }

    public function getAgenceLib(): ?string
    {
        return $this->agence_lib;
    }

    public function setAgenceLib(string $agence_lib): self
    {
        $this->agence_lib = $agence_lib;

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(?Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Collection|Profil[]
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
            $profil->addAgence($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->contains($profil)) {
            $this->profils->removeElement($profil);
            $profil->removeAgence($this);
        }

        return $this;
    }
}
