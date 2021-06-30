<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PatronRestaurant;
use App\Repository\RestaurantRepository;
use App\Repository\PatronPrestataireRepository;
use App\Repository\PrestataireRepository;
use App\Repository\MissionRepository;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/restaurant_owner/{id}", name="profileResto")
     */
    public function resto(PatronRestaurant $patronResto, RestaurantRepository $restaurants): Response
    {
        return $this->render('profile/restaurant.html.twig', [
            'patron' => $patronResto,
            'restaurants'=>$restaurants->findBy(['patronRestaurant' => $patronResto], ['nom' => 'DESC']),
        ]);
    }

    /**
     * @Route("/profile/service_owner/{id}", name="profileService")
     */
    public function service(PatronPrestataireRepository $patronService, int $id): Response
    {
        $infosPatron = $patronService->getPatronInfos($id);
        $infosPrestataires = $patronService->getPrestatairesInfos(($id));

        return $this->render('profile/service.html.twig', [
            'infosPatron' => $infosPatron,
            'infosPrestataires'=>$infosPrestataires,
        ]);
    }

    /**
     * @Route("/profile/service_owner/{id}/missions", name="missionsPresta")
     */
    public function missions(PatronPrestataireRepository $patronService, int $id, MissionRepository $missions, PrestataireRepository $prestataire): Response
    {
        $allMissions = $missions->getMissions($id);
        /*$restaurant = $prestataire->getRestaurant($id);*/

        return $this->render('profile/missions.html.twig', [
            'missions'=>$allMissions,
            /*'restaurant'=>$restaurant,*/
        ]);
    }
}
