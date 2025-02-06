<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Matches>
     */
    #[ORM\ManyToMany(targetEntity: Matches::class)]
    private Collection $martch_id;

    /**
     * @var Collection<int, Teams>
     */
    #[ORM\ManyToMany(targetEntity: Teams::class)]
    private Collection $winner_team;

    public function __construct()
    {
        $this->martch_id = new ArrayCollection();
        $this->winner_team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Matches>
     */
    public function getMartchId(): Collection
    {
        return $this->martch_id;
    }

    public function addMartchId(Matches $martchId): static
    {
        if (!$this->martch_id->contains($martchId)) {
            $this->martch_id->add($martchId);
        }

        return $this;
    }

    public function removeMartchId(Matches $martchId): static
    {
        $this->martch_id->removeElement($martchId);

        return $this;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getWinnerTeam(): Collection
    {
        return $this->winner_team;
    }

    public function addWinnerTeam(Teams $winnerTeam): static
    {
        if (!$this->winner_team->contains($winnerTeam)) {
            $this->winner_team->add($winnerTeam);
        }

        return $this;
    }

    public function removeWinnerTeam(Teams $winnerTeam): static
    {
        $this->winner_team->removeElement($winnerTeam);

        return $this;
    }
}
