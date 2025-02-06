<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teams $team_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTeamId(): ?Teams
    {
        return $this->team_id;
    }

    public function setTeamId(?Teams $team_id): static
    {
        $this->team_id = $team_id;

        return $this;
    }
    public function __toString(): string
    {
        return $this->user_id 
            ? $this->user_id->getFirstName() . ' ' . $this->user_id->getLastName() 
            : 'Joueur inconnu';
    }
    
    
}
