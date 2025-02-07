<?php

// src/Controller/TeamController.php

namespace App\Controller;

use App\Entity\Teams;
use App\Form\TeamType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function createTeam(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Crée une nouvelle instance de l'entité Teams
        $team = new Teams();

        // Crée le formulaire
        $form = $this->createForm(TeamType::class, $team);

        // Gère la soumission du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, on enregistre l'équipe dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            // Redirection ou message de succès
            $this->addFlash('success', 'L\'équipe a été créée avec succès!');

            return $this->redirectToRoute('app_team');
        }

        return $this->render('team/create_team.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

