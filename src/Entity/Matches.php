<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(targetEntity: Tournaments::class, inversedBy: "matches")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournaments $tournament_id = null;


    #[ORM\Column]
    private ?int $round = null;

    #[ORM\ManyToOne(targetEntity: Teams::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Teams $team1_id = null; 

    #[ORM\ManyToOne(targetEntity: Teams::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Teams $team2_id = null; 

    #[ORM\Column]
    private ?int $team1_score = null;

    #[ORM\Column]
    private ?int $team2_score = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $match_date = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTournamentId(): ?Tournaments
    {
        return $this->tournament_id;
    }
    
    public function setTournamentId(?Tournaments $tournament_id): static
    {
        $this->tournament_id = $tournament_id;
        return $this;
    }
    

    public function getRound(): ?int
    {
        return $this->round;
    }

    public function setRound(int $round): static
    {
        $this->round = $round;

        return $this;
    }


    public function getTeam1Id(): ?Teams
    {
        return $this->team1_id;
    }

    public function setTeam1Id(?Teams $team1_id): static
    {
        $this->team1_id = $team1_id;
        return $this;
    }

    public function getTeam2Id(): ?Teams
    {
        return $this->team2_id;
    }

    public function setTeam2Id(?Teams $team2_id): static
    {
        $this->team2_id = $team2_id;
        return $this;
    }

    public function getTeam1Score(): ?int
    {
        return $this->team1_score;
    }

    public function setTeam1Score(int $team1_score): static
    {
        $this->team1_score = $team1_score;

        return $this;
    }

    public function getTeam2Score(): ?int
    {
        return $this->team2_score;
    }

    public function setTeam2Score(int $team2_score): static
    {
        $this->team2_score = $team2_score;

        return $this;
    }

    public function getMatchDate(): ?\DateTimeInterface
    {
        return $this->match_date;
    }

    public function setMatchDate(\DateTimeInterface $match_date): static
    {
        $this->match_date = $match_date;

        return $this;
    }
}
