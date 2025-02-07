<?php
namespace App\Entity;

use App\Repository\TeamTournamentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamTournamentRepository::class)]
class TeamTournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Tournaments::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Tournaments $tournament = null;

    #[ORM\ManyToOne(targetEntity: Teams::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teams $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournament(): ?Tournaments
    {
        return $this->tournament;
    }

    public function setTournament(Tournaments $tournament): static
    {
        $this->tournament = $tournament;
        return $this;
    }

    public function getTeam(): ?Teams
    {
        return $this->team;
    }

    public function setTeam(Teams $team): static
    {
        $this->team = $team;
        return $this;
    }
}
