<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match
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
    private $idMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $temps;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Utilisateur")
     */
    private $arbitre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Niveau")
     */
    private $niveau;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Terrain")
     */
    private $terrain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Equipe")
     */
    private $premiereEquipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Equipe")
     */
    private $DeuxiemeEquipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
    }

    public function setIdMatch(int $idMatch): self
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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

    public function getArbitre(): ?int
    {
        return $this->arbitre;
    }

    public function setArbitre(?int $arbitre): self
    {
        $this->arbitre = $arbitre;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getTerrain(): ?int
    {
        return $this->terrain;
    }

    public function setTerrain(?int $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }

    public function getPremiereEquipe(): ?int
    {
        return $this->premiereEquipe;
    }

    public function setPremiereEquipe(?int $premiereEquipe): self
    {
        $this->premiereEquipe = $premiereEquipe;

        return $this;
    }

    public function getDeuxiemeEquipe(): ?int
    {
        return $this->DeuxiemeEquipe;
    }

    public function setDeuxiemeEquipe(?int $DeuxiemeEquipe): self
    {
        $this->DeuxiemeEquipe = $DeuxiemeEquipe;

        return $this;
    }
}
