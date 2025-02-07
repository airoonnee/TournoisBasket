<?php
namespace App\Controller;

use App\Entity\Players;
use App\Entity\Teams;
use App\Repository\TeamsRepository;
use App\Repository\PlayersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllTeamController extends AbstractController
{
    #[Route('/all/team', name: 'app_all_team')]
    public function index(TeamsRepository $teamsRepository): Response
    {
        $teams = $teamsRepository->findAll();

        return $this->render('all_team/index.html.twig', [
            'teams' => $teams,
        ]);
    }

    #[Route('/team/join/{teamId}', name: 'app_join_team')]
    public function joinTeam(int $teamId, EntityManagerInterface $entityManager, PlayersRepository $playersRepository): Response
    {
        $user = $this->getUser(); // Assurez-vous que l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirection vers la page de login si l'utilisateur n'est pas connecté
        }

        $team = $entityManager->getRepository(Teams::class)->find($teamId);

        if (!$team) {
            $this->addFlash('error', 'L\'équipe n\'existe pas.');
            return $this->redirectToRoute('app_all_team');
        }

        // Vérifier si le joueur est déjà dans une équipe
        $existingPlayer = $playersRepository->findOneBy(['user_id' => $user]);

        if ($existingPlayer) {
            $this->addFlash('error', 'Vous êtes déjà dans une équipe.');
            return $this->redirectToRoute('app_all_team');
        }

        // Créer un nouveau joueur et l'ajouter à l'équipe
        $player = new Players();
        $player->setUserId($user);
        $player->setTeamId($team);

        $entityManager->persist($player);
        $entityManager->flush();

        $this->addFlash('error', 'Vous êtes déjà dans une équipe.');

        $this->addFlash('success', 'Vous avez rejoint l\'équipe ' . $team->getName() . ' avec succès !');
        return $this->redirectToRoute('app_all_team');
    }
}
