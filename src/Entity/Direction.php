<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DirectionRepository")
 */
class Direction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $direction_code;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $direction_lib;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $OZ;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agence", mappedBy="direction")
     */
    private $agences;

    public function __construct()
    {
        $this->agences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDirectionCode(): ?string
    {
        return $this->direction_code;
    }

    public function setDirectionCode(string $direction_code): self
    {
        $this->direction_code = $direction_code;

        return $this;
    }

    public function getDirectionLib(): ?string
    {
        return $this->direction_lib;
    }

    public function setDirectionLib(string $direction_lib): self
    {
        $this->direction_lib = $direction_lib;

        return $this;
    }

    public function getOZ(): ?string
    {
        return $this->OZ;
    }

    public function setOZ(?string $OZ): self
    {
        $this->OZ = $OZ;

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
            $agence->setDirection($this);
        }

        return $this;
    }

    public function removeAgence(Agence $agence): self
    {
        if ($this->agences->contains($agence)) {
            $this->agences->removeElement($agence);
            // set the owning side to null (unless already changed)
            if ($agence->getDirection() === $this) {
                $agence->setDirection(null);
            }
        }

        return $this;
    }
}
