<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Hour;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Equipement;
use App\Entity\Opinion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    //#[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecfgparrot - Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Véhicules', 'fas fa-car', Car::class);
        yield MenuItem::linkToCrud('Equipements', 'fas fa-screwdriver-wrench', Equipement::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-comment', Opinion::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', Hour::class);
    }
}
