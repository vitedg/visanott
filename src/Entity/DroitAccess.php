<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DroitAccessRepository")
 */
class DroitAccess
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $droit_import;

    /**
     * @ORM\Column(type="boolean")
     */
    private $droit_admin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Role", mappedBy="droit_access")
     */
    private $roles;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin_national;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


	public function toString() : ?string
         	{
         		if (( $this->droit_import == 0) && ($this -> droit_admin == 0) && ($this -> admin_national == 0))
         		{
         			return ("Traitement Des Anomalies ");
         		}else if(( $this->droit_import == 1) && ($this -> droit_admin == 0)  && ($this -> admin_national == 0))
         		{
         			return ("Import");
         		}else if(( $this->droit_import == 0) && ($this -> droit_admin == 1) && ($this -> admin_national == 0) )
         		{
         			return ("Admin");
         		}else if(( $this->droit_import == 1) && ($this -> droit_admin == 1) && ($this -> admin_national == 0) )
         		{
         			return ("Droit Import,Droit Admin");
         		}else if($this -> admin_national == 1 )
         		{
         			return ("Admin National");
         		}
         	}


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDroitImport(): ?bool
    {
        return $this->droit_import;
    }

    public function setDroitImport(bool $droit_import): self
    {
        $this->droit_import = $droit_import;

        return $this;
    }

    public function getDroitAdmin(): ?bool
    {
        return $this->droit_admin;
    }

    public function setDroitAdmin(bool $droit_admin): self
    {
        $this->droit_admin = $droit_admin;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setDroitAccess($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            // set the owning side to null (unless already changed)
            if ($role->getDroitAccess() === $this) {
                $role->setDroitAccess(null);
            }
        }

        return $this;
    }

    public function getAdminNational(): ?bool
    {
        return $this->admin_national;
    }

    public function setAdminNational(bool $admin_national): self
    {
        $this->admin_national = $admin_national;

        return $this;
    }
}
