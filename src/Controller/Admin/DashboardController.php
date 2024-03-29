<?php

namespace App\Controller\Admin;

use App\Entity\Allergenes;
use App\Entity\User;
use App\Entity\Recettes;
use App\Entity\CommentsRecettes;
use App\Entity\Regimes;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admine', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

        return $this->render('pages/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sandrine Coupart');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('recettes', 'fas fa-list', Recettes::class);
         yield MenuItem::linkToCrud('patients', 'fa-solid fa-user', User::class);
         yield MenuItem::linkToCrud('commentsRecettes', 'fa-regular fa-comment', CommentsRecettes::class);
         yield MenuItem::linkToCrud('regimes', 'fa-regular fa-comment', Regimes::class);
         yield MenuItem::linkToCrud('allergenes', 'fa-regular fa-comment', Allergenes::class);
         
    }
}
