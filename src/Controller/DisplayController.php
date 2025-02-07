<?php

namespace App\Controller;

use App\Repository\TournamentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DisplayController extends AbstractController
{
    #[Route('/tournaments', name: 'app_display')]
    public function index(TournamentsRepository $tournamentsRepository): Response
    {
        // Récupère tous les tournois
        $tournaments = $tournamentsRepository->findAll();
        
        // Date actuelle pour la comparaison
        $now = new \DateTime();

        // Ajoute le statut à chaque tournoi
        foreach ($tournaments as $tournament) {
            // Détermine le statut du tournoi
            if ($tournament->getStartDate() <= $now && $tournament->getEndDate() >= $now) {
                $tournament->status = 'ongoing';
            } elseif ($tournament->getStartDate() > $now) {
                $tournament->status = 'upcoming';
            } elseif ($tournament->getEndDate() < $now) {
                $tournament->status = 'finished';
            }
        }

        return $this->render('display/tournament.html.twig', [
            'controller_name' => 'DisplayController',
            'tournaments' => $tournaments,
        ]);
    }
}

