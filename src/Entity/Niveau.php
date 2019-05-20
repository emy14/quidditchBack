<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
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
    private $idNiveau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdNiveau(): ?int
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(int $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
