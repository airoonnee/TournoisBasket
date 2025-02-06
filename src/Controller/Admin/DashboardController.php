<?php

namespace App\Controller\Admin;

use App\Entity\User;

use App\Entity\Matches;
use App\Entity\Players;
use App\Entity\Position;
use App\Entity\Results;
use App\Entity\Teams;
use App\Entity\TeamTournament;
use App\Entity\Tournaments;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route(path:"/admin", name:"admin")]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetBasket');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Matches', 'fas fa-list', Matches::class);
        yield MenuItem::linkToCrud('Joueur', 'fas fa-list', Players::class);
        yield MenuItem::linkToCrud('Post', 'fas fa-list', Position::class);
        yield MenuItem::linkToCrud('Resultat Tournois', 'fas fa-list', Results::class);
        yield MenuItem::linkToCrud('Équipes', 'fas fa-list', Teams::class);
        yield MenuItem::linkToCrud('Inscription Tournois', 'fas fa-list', TeamTournament::class);
        yield MenuItem::linkToCrud('Tournois', 'fas fa-list', Tournaments::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);

    }
}
