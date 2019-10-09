<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteCom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="idLC")
     */
    private $idCom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="idLC")
     */
    private $idProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteCom(): ?int
    {
        return $this->qteCom;
    }

    public function setQteCom(int $qteCom): self
    {
        $this->qteCom = $qteCom;

        return $this;
    }

    public function getIdCom(): ?Commande
    {
        return $this->idCom;
    }

    public function setIdCom(?Commande $idCom): self
    {
        $this->idCom = $idCom;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }
}
