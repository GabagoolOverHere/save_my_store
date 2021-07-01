<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RestaurantRepository;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index(RestaurantRepository $restaurants): Response
    {
        $restoProblems = $restaurants->getRestaurantsAndProblems();

        return $this->render('map/index.html.twig', [
            'restaurants' => $restoProblems,
        ]);
    }
}
