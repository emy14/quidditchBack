<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @ORM\Table(name="match_table")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scorePremiereEquipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreDeuxiemeEquipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $temps;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="arbitre", referencedColumnName="idUtilisateur", onDelete="CASCADE")
     */
    private $arbitre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="idUtilisateur", onDelete="CASCADE")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau")
     * @ORM\JoinColumn(name="niveau", referencedColumnName="idNiveau",onDelete="CASCADE")
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terrain")
     * @ORM\JoinColumn(name="terrain", referencedColumnName="idTerrain",onDelete="CASCADE")
     */
    private $terrain;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(name="premiereEquipe", referencedColumnName="idEquipe", onDelete="CASCADE")
     */
    private $premiereEquipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(name="deuxiemeEquipe", referencedColumnName="idEquipe", onDelete="CASCADE")
     */
    private $deuxiemeEquipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tournoi")
     * @ORM\JoinColumn(name="tournoi", referencedColumnName="idTournoi",onDelete="CASCADE")
     */
    private $tournoi;


    public function getIdMatch(): ?int
    {
        return $this->idMatch;
    }

    public function getScorePremiereEquipe(): ?int
    {
        return $this->scorePremiereEquipe;
    }

    public function setScorePremiereEquipe(?int $score): self
    {
        $this->scorePremiereEquipe = $score;

        return $this;
    }

    public function getScoreDeuxiemeEquipe(): ?int
    {
        return $this->scoreDeuxiemeEquipe;
    }

    public function setScoreDeuxiemeEquipe(?int $score): self
    {
        $this->scoreDeuxiemeEquipe = $score;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(?int $temps): self
    {
        $this->temps = $temps;

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
     * Get arbitre
     *
     * @return \App\Entity\Utilisateur $arbitre
     */
    public function getArbitre()
    {
        return $this->arbitre;
    }

    /**
     * Set arbitre
     *
     * @param \App\Entity\Utilisateur $arbitre
     *
     * @return Match
     */
    public function setArbitre(Utilisateur $arbitre)
    {
        $this->arbitre = $arbitre;

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


    /**
     * Get niveau
     *
     * @return \App\Entity\Niveau $niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set niveau
     *
     * @param \App\Entity\Niveau $niveau
     *
     * @return Match
     */
    public function setNiveau(Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return \App\Entity\Terrain $terrain
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * Set terrain
     *
     * @param \App\Entity\Terrain $terrain
     *
     * @return Match
     */
    public function setTerrain(Terrain $terrain = null)
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \App\Entity\Equipe $equipe
     */
    public function getPremiereEquipe()
    {
        return $this->premiereEquipe;
    }

    /**
     * Set equipe
     *
     * @param \App\Entity\Equipe $equipe
     *
     * @return Match
     */
    public function setPremiereEquipe(Equipe $premiereEquipe = null)
    {
        $this->premiereEquipe = $premiereEquipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \App\Entity\Equipe $equipe
     */
    public function getDeuxiemeEquipe()
    {
        return $this->deuxiemeEquipe;
    }

    /**
     * Set equipe
     *
     * @param \App\Entity\Equipe $equipe
     *
     * @return Match
     */
    public function setDeuxiemeEquipe(Equipe $deuxiemeEquipe = null)
    {
        $this->deuxiemeEquipe = $deuxiemeEquipe;

        return $this;
    }

    /**
     * Get tournoi
     *
     * @return \App\Entity\Tournoi $tournoi
     */
    public function getTournoi()
    {
        return $this->tournoi;
    }

    /**
     * Set tournoi
     *
     * @param \App\Entity\Terrain $terrain
     *
     * @return Match
     */
    public function setTournoi(Tournoi $tournoi = null)
    {
        $this->tournoi = $tournoi;

        return $this;
    }
}
