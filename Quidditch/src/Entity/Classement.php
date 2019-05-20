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
    private $id;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournoi(): ?int
    {
        return $this->tournoi;
    }

    public function setTournoi(int $tournoi): self
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    public function getEquipe(): ?int
    {
        return $this->equipe;
    }

    public function setEquipe(int $equipe): self
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
