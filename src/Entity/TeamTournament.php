<?php

namespace App\Entity;

use App\Repository\TeamTournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamTournamentRepository::class)]
class TeamTournament
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

    /**
     * @var Collection<int, Teams>
     */
    #[ORM\ManyToMany(targetEntity: Teams::class)]
    private Collection $team_id;

    public function __construct()
    {
        $this->tournament_id = new ArrayCollection();
        $this->team_id = new ArrayCollection();
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

    /**
     * @return Collection<int, Teams>
     */
    public function getTeamId(): Collection
    {
        return $this->team_id;
    }

    public function addTeamId(Teams $teamId): static
    {
        if (!$this->team_id->contains($teamId)) {
            $this->team_id->add($teamId);
        }

        return $this;
    }

    public function removeTeamId(Teams $teamId): static
    {
        $this->team_id->removeElement($teamId);

        return $this;
    }
}
