<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PatronPrestataireRepository;
use App\Repository\PrestataireRepository;
use App\Repository\MissionRepository;
use App\Repository\PatronRestaurantRepository;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/restaurant_owner/{id}", name="profileResto")
     */
    public function resto(PatronRestaurantRepository $patronResto, int $id): Response
    {
        $infosPatron = $patronResto->getPatronInfos($id);
        $infosRestaurants = $patronResto->getRestaurantsInfos(($id));

        return $this->render('profile/restaurant.html.twig', [
            'infosPatron' => $infosPatron,
            'infosRestaurants' => $infosRestaurants,
        ]);
    }

    /**
     * @Route("/profile/restaurant_owner/{id}/missions", name="missionsResto")
     */
    public function missionsResto(
        int $id,
        RestaurantRepository $restaurants
    ): Response {
        $allMissions = $restaurants->getRestoMissions($id);

        return $this->render('profile/missions.html.twig', [
            'missions' => $allMissions,
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
            'infosPrestataires' => $infosPrestataires,
        ]);
    }

    /**
     * @Route("/profile/service_owner/{id}/missions", name="missionsPresta")
     */
    public function missionsPresta(
        PatronPrestataireRepository $patronService,
        int $id,
        MissionRepository $missions,
        PrestataireRepository $prestataire
    ): Response {
        $allMissions = $missions->getPrestaMissions($id);
        /*$restaurant = $prestataire->getRestaurant($id);*/

        return $this->render('profile/missions.html.twig', [
            'missions' => $allMissions,
            /*'restaurant'=>$restaurant,*/
        ]);
    }
}
