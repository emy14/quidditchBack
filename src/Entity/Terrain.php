<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TerrainRepository")
 */
class Terrain
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="idTerrain", type="integer")
     */
    private $idTerrain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(name="lieu", referencedColumnName="idPays")
     */
    private $lieu;

    public function getIdTerrain(): ?int
    {
        return $this->idTerrain;
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

    /**
     * Get lieu
     *
     * @return \App\Entity\Pays $lieu
     */

    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set lieu
     *
     * @param \App\Entity\Pays $lieu
     *
     * @return Pays
     */

    public function setLieu(Pays $lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }
}
