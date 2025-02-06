<?php

namespace App\Controller;

use App\Repository\MatchesRepository;
use App\Repository\TournamentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MatchesController extends AbstractController
{
    #[Route('/matches/{id}', name: 'app_matches')]
    public function index(int $id, MatchesRepository $matchesRepository, TournamentsRepository $tournamentsRepository): Response
    {
        // Récupère le tournoi par son ID
        $tournament = $tournamentsRepository->find($id);

        if (!$tournament) {
            throw $this->createNotFoundException('Tournoi introuvable.');
        }

        // Récupère tous les matchs liés à ce tournoi
        $matches = $matchesRepository->findBy(['tournament_id' => $tournament]);

        return $this->render('matches/index.html.twig', [
            'tournament' => $tournament,
            'matches' => $matches,
        ]);
    }
}
