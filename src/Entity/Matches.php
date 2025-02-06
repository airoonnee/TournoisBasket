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

    /**
     * @var Collection<int, Tournaments>
     */
    #[ORM\ManyToMany(targetEntity: Tournaments::class)]
    private Collection $tournament_id;

    #[ORM\Column]
    private ?int $round = null;

    /**
     * @var Collection<int, Teams>
     */
    #[ORM\ManyToOne(targetEntity: Teams::class)]
    private Collection $team1_id;

    /**
     * @var Collection<int, Teams>
     */
    #[ORM\ManyToOne(targetEntity: Teams::class)]
    private Collection $team2_id;

    #[ORM\Column]
    private ?int $team1_score = null;

    #[ORM\Column]
    private ?int $team2_score = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $match_date = null;

    public function __construct()
    {
        $this->tournament_id = new ArrayCollection();
        $this->team1_id = new ArrayCollection();
        $this->team2_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Tournaments>
     */
    public function getTournamentId(): Collection
    {
        return $this->tournament_id;
    }

    public function addTournamentId(Tournaments $tournamentId): static
    {
        if (!$this->tournament_id->contains($tournamentId)) {
            $this->tournament_id->add($tournamentId);
        }

        return $this;
    }

    public function removeTournamentId(Tournaments $tournamentId): static
    {
        $this->tournament_id->removeElement($tournamentId);

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

    /**
     * @return Collection<int, Teams>
     */
    public function getTeam1Id(): Collection
    {
        return $this->team1_id;
    }

    public function addTeam1Id(Teams $team1Id): static
    {
        if (!$this->team1_id->contains($team1Id)) {
            $this->team1_id->add($team1Id);
        }

        return $this;
    }

    public function removeTeam1Id(Teams $team1Id): static
    {
        $this->team1_id->removeElement($team1Id);

        return $this;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getTeam2Id(): Collection
    {
        return $this->team2_id;
    }

    public function addTeam2Id(Teams $team2Id): static
    {
        if (!$this->team2_id->contains($team2Id)) {
            $this->team2_id->add($team2Id);
        }

        return $this;
    }

    public function removeTeam2Id(Teams $team2Id): static
    {
        $this->team2_id->removeElement($team2Id);

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
