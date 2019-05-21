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
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="arbitre", referencedColumnName="idUtilisateur")
     */
    private $arbitre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau")
     * @ORM\JoinColumn(name="niveau", referencedColumnName="idNiveau")
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terrain")
     * @ORM\JoinColumn(name="terrain", referencedColumnName="idTerrain")
     */
    private $terrain;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(name="premiereEquipe", referencedColumnName="idEquipe")
     */
    private $premiereEquipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(name="deuxiemeEquipe", referencedColumnName="idEquipe")
     */
    private $deuxiemeEquipe;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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
}
