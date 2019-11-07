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
     * @ORM\Column(type="integer")
     */
    private $numc;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LCommande", mappedBy="commande", orphanRemoval=true, cascade={"persist","remove"})
     */
    private $LCommande;

    public function __construct()
    {
        $this->LCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumc(): ?int
    {
        return $this->numc;
    }

    public function setNumc(int $numc): self
    {
        $this->numc = $numc;

        return $this;
    }

    public function getDateComm(): ?\DateTimeInterface
    {
        return $this->dateComm;
    }

    public function setDateComm(\DateTimeInterface $dateComm): self
    {
        $this->dateComm = $dateComm;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|LCommande[]
     */
    public function getLCommande(): Collection
    {
        return $this->LCommande;
    }

    public function addLCommande(LCommande $lCommande): self
    {
        if (!$this->LCommande->contains($lCommande)) {
            $this->LCommande[] = $lCommande;
            $lCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLCommande(LCommande $lCommande): self
    {
        if ($this->LCommande->contains($lCommande)) {
            $this->LCommande->removeElement($lCommande);
            // set the owning side to null (unless already changed)
            if ($lCommande->getCommande() === $this) {
                $lCommande->setCommande(null);
            }
        }

        return $this;
    }
}
