<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassementRepository")
 */
class Classement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idClassement;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Tournoi")
     */
    private $tournoi;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Quidditch\Entity\Equipe")
     */
    private $equipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang;

    public function getIdClassement(): ?int
    {
        return $this->id;
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
     * @param \App\Entity\Tournoi $tournoi
     *
     * @return Classement
     */
    public function setTournoi(Tournoi $tournoi = null)
    {
        $this->tournoi = $tournoi;

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
     * @return Classement
     */
    public function setEquipe(Equipe $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }
}
