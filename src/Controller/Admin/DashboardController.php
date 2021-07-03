<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PatronPrestataire;
use App\Entity\Restaurant;
use App\Entity\Prestataire;
use App\Entity\Probleme;
use App\Entity\Quartier;
use App\Entity\PatronRestaurant;
use App\Entity\TypeProbleme;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setFaviconPath('/images/LogoSMSdark2.png')
            ->setTitle('<img src="/images/LogoSMSdark2.png" style="width: 50px;"> Save My Store - Interface d\'Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Quartiers', 'fas fa-project-diagram', Quartier::class);
        yield MenuItem::linkToCrud('Missions', 'fas fa-bullseye', Mission::class);
        yield MenuItem::linkToCrud('Patrons de Prestataire', 'fas fa-address-book', PatronPrestataire::class);
        yield MenuItem::linkToCrud('Patrons de Restaurant', 'fas fa-address-book', PatronRestaurant::class);
        yield MenuItem::linkToCrud('Prestataires', 'fas fa-concierge-bell', Prestataire::class);
        yield MenuItem::linkToCrud('Restaurants', 'fas fa-utensils', Restaurant::class);
        yield MenuItem::linkToCrud('Problèmes', 'fas fa-exclamation-triangle', Probleme::class);
        yield MenuItem::linkToCrud('Types de Problème', 'fas fa-sort-amount-down-alt', TypeProbleme::class);
        yield MenuItem::linkToUrl('Retourner sur l\'index', 'fas fa-home', '/');
    }
}
