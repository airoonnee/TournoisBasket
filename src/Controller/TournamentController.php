<?php 

namespace App\Controller;

use App\Entity\Tournaments;
use App\Entity\TeamTournament;
use App\Repository\PlayersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament/register/{tournament_id}', name: 'app_register_team')]
    public function register(
        int $tournament_id,
        PlayersRepository $playersRepository,
        EntityManagerInterface $entityManager
    ): RedirectResponse {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour inscrire votre équipe.');
            return $this->redirectToRoute('app_display');
        }

        $player = $playersRepository->findOneBy(['user_id' => $user]);
        if (!$player || !$player->getTeamId()) {
            $this->addFlash('error', 'Vous devez appartenir à une équipe pour inscrire votre équipe.');
            return $this->redirectToRoute('app_display');
        }

        $team = $player->getTeamId();
        $tournament = $entityManager->getRepository(Tournaments::class)->find($tournament_id);

        if (!$tournament) {
            $this->addFlash('error', 'Tournoi introuvable.');
            return $this->redirectToRoute('app_display');
        }

        // Vérifie si l'équipe est déjà inscrite
        $existingEntry = $entityManager->getRepository(TeamTournament::class)->findOneBy([
            'tournament' => $tournament,
            'team' => $team,
        ]);

        if ($existingEntry) {
            $this->addFlash('error', 'Votre équipe est déjà inscrite à ce tournoi.');
            return $this->redirectToRoute('app_display');
        }

        // Inscription de l'équipe au tournoi
        $tournamentTeam = new TeamTournament();
        $tournamentTeam->setTournament($tournament);
        $tournamentTeam->setTeam($team);
        $entityManager->persist($tournamentTeam);
        $entityManager->flush();

        $this->addFlash('success', 'Votre équipe a été inscrite avec succès !');
        return $this->redirectToRoute('app_display');
    }
}
