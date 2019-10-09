<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="idCom")
     */
    private $idLC;


    

    public function __construct()
    {
        $this->idProduit = new ArrayCollection();
        $this->idLC = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): self
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    /**
     * @return Collection|LigneCommande[]
     */
    public function getIdLC(): Collection
    {
        return $this->idLC;
    }

    public function addIdLC(LigneCommande $idLC): self
    {
        if (!$this->idLC->contains($idLC)) {
            $this->idLC[] = $idLC;
            $idLC->setIdCom($this);
        }

        return $this;
    }

    public function removeIdLC(LigneCommande $idLC): self
    {
        if ($this->idLC->contains($idLC)) {
            $this->idLC->removeElement($idLC);
            // set the owning side to null (unless already changed)
            if ($idLC->getIdCom() === $this) {
                $idLC->setIdCom(null);
            }
        }

        return $this;
    }

    // public function __toString()
    // {
    //     return $this->dateCom;
    // }
}
