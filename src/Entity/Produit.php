<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\Column(type="integer")
     */
    private $pu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="idProduit")
     */
    private $idCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="idProduit")
     */
    private $idLC;

    public function __construct()
    {
        $this->idCom = new ArrayCollection();
        $this->idLC = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPu(): ?int
    {
        return $this->pu;
    }

    public function setPu(int $pu): self
    {
        $this->pu = $pu;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categorie $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

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
            $idLC->setIdProduit($this);
        }

        return $this;
    }

    public function removeIdLC(LigneCommande $idLC): self
    {
        if ($this->idLC->contains($idLC)) {
            $this->idLC->removeElement($idLC);
            // set the owning side to null (unless already changed)
            if ($idLC->getIdProduit() === $this) {
                $idLC->setIdProduit(null);
            }
        }

        return $this;
    }

    public function __toString()
  {
      return $this->createChoiceLabel();
  }
}
