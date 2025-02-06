<?php

namespace App\Controller;

use App\Repository\TournamentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DisplayController extends AbstractController
{
    #[Route('/tournaments', name: 'app_display')]
    public function index(TournamentsRepository $tournamentsRepository): Response
    {
        //recepère tous les tournois
        $tournaments = $tournamentsRepository->findAll();
        return $this->render('display/tournament.html.twig', [
            'controller_name' => 'DisplayController',
            'tournaments' => $tournaments,
        ]);
    }
}
