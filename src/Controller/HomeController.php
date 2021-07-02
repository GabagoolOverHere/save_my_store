<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('home/services.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/story', name: 'story')]
    public function story(): Response
    {
        return $this->render('home/story.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('home/register.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
