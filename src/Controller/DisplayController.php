<?php   
namespace App\Controller;

use App\Repository\TournamentsRepository;
use App\Repository\PlayersRepository;
use App\Repository\TeamsRepository;
use App\Repository\TeamTournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DisplayController extends AbstractController
{
    #[Route('/tournaments', name: 'app_display')]
    public function index(
        TournamentsRepository $tournamentsRepository,
        PlayersRepository $playersRepository,
        TeamTournamentRepository  $tournamentsTeamsRepository
    ): Response {
        $user = $this->getUser();
        $team = null;
        $isRegistered = [];

        if ($user) {
            $player = $playersRepository->findOneBy(['user_id' => $user]);
            if ($player) {
                $team = $player->getTeamId();
            }
        }

        $tournaments = $tournamentsRepository->findAll();
        $now = new \DateTime();

        foreach ($tournaments as $tournament) {
            if ($tournament->getStartDate() <= $now && $tournament->getEndDate() >= $now) {
                $tournament->status = 'ongoing';
            } elseif ($tournament->getStartDate() > $now) {
                $tournament->status = 'upcoming';
            } elseif ($tournament->getEndDate() < $now) {
                $tournament->status = 'finished';
            }

            // Vérifier si l'équipe est déjà inscrite
            $isRegistered[$tournament->getId()] = $team
            ? $tournamentsTeamsRepository->findOneBy(['tournament' => $tournament, 'team' => $team]) !== null
            : false;
        
        }

        return $this->render('display/tournament.html.twig', [
            'controller_name' => 'DisplayController',
            'tournaments' => $tournaments,
            'team' => $team,
            'isRegistered' => $isRegistered,
        ]);
    }
}
