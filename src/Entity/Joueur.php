<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 */
class Joueur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idJoueur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(name="nationalite", referencedColumnName="idPays" ,onDelete="CASCADE")
     */

    private $nationalite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Poste")
     * @ORM\JoinColumn(name="poste", referencedColumnName="idPoste" ,onDelete="CASCADE")
     */
    private $poste;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(name="equipe", referencedColumnName="idEquipe",onDelete="CASCADE")
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau")
     * @ORM\JoinColumn(name="league", referencedColumnName="idNiveau",onDelete="CASCADE")
     */
    private $league;

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
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
     * Get nationalite
     *
     * @return \App\Entity\Pays $nationalite
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set nationalite
     *
     * @param \App\Entity\Pays $nationalite
     *
     * @return Pays
     */
    public function setNationalite(Pays $nationalite = null)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \App\Entity\Poste $poste
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set poste
     *
     * @param \App\Entity\Poste $poste
     *
     * @return Joueur
     */
    public function setPoste(Poste $poste = null)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \App\Entity\Equipe $equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set equipe
     *
     * @param \App\Entity\Equipe $equipe
     *
     * @return Joueur
     */
    public function setEquipe(Equipe $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get league
     *
     * @return \App\Entity\Niveau $league
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set league
     *
     * @param \App\Entity\Niveau $league
     *
     * @return Niveau
     */
    public function setLeague(Niveau $league = null)
    {
        $this->league = $league;

        return $this;
    }
}
