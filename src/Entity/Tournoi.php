<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TournoiRepository")
 */
class Tournoi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="idTournoi", type="integer")
     */
    private $idTournoi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(name="pays", referencedColumnName="idPays", onDelete="CASCADE")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="idUtilisateur", onDelete="CASCADE")
     */
    private $createdBy;


    public function getIdTournoi(): ?int
    {
        return $this->idTournoi;
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date): self
    {
        $this->date_debut = $date;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date): self
    {
        $this->date_fin = $date;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \App\Entity\Pays $pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set pays
     *
     * @param \App\Entity\Pays $pays
     *
     * @return Pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }


    /**
     * Get createdBy
     *
     * @return \App\Entity\Utilisateur $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @return \App\Entity\Utilisateur $createdBy
     *
     * @return Utilisateur
     */
    public function setCreatedBy(Utilisateur $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
