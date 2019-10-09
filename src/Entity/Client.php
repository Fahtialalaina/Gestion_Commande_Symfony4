<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="idClient")
     */
    private $idCom;


    public function __construct()
    {
        $this->idCom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getIdCom(): Collection
    {
        return $this->idCom;
    }

    public function addIdCom(Commande $idCom): self
    {
        if (!$this->idCom->contains($idCom)) {
            $this->idCom[] = $idCom;
            $idCom->setIdClient($this);
        }

        return $this;
    }

    public function removeIdCom(Commande $idCom): self
    {
        if ($this->idCom->contains($idCom)) {
            $this->idCom->removeElement($idCom);
            // set the owning side to null (unless already changed)
            if ($idCom->getIdClient() === $this) {
                $idCom->setIdClient(null);
            }
        }

        return $this;
    }
}
