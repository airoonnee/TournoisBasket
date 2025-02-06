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

    /**
     * @var Tournaments
     */
    #[ORM\OneToOne(targetEntity: Tournaments::class)]
    #[ORM\JoinColumn(nullable: false)] // Assurez-vous que la relation est obligatoire
    private ?Tournaments $tournament_id = null;

    /**
     * @var Teams
     */
    #[ORM\OneToOne(targetEntity: Teams::class)]
    #[ORM\JoinColumn(nullable: false)] // Assurez-vous que la relation est obligatoire
    private ?Teams $team_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournamentId(): ?Tournaments
    {
        return $this->tournament_id;
    }

    public function setTournamentId(Tournaments $tournamentId): static
    {
        $this->tournament_id = $tournamentId;

        return $this;
    }

    public function getTeamId(): ?Teams
    {
        return $this->team_id;
    }

    public function setTeamId(Teams $teamId): static
    {
        $this->team_id = $teamId;

        return $this;
    }
}
