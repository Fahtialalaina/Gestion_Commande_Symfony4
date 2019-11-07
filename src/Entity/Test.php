<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
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
    private $esr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEsr(): ?string
    {
        return $this->esr;
    }

    public function setEsr(string $esr): self
    {
        $this->esr = $esr;

        return $this;
    }
}
