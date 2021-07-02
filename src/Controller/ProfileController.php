<?php

namespace App\Controller;

use App\Entity\PatronRestaurant;
use App\Form\RegistrationFormType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PatronPrestataireRepository;
use App\Repository\PrestataireRepository;
use App\Repository\MissionRepository;
use App\Repository\PatronRestaurantRepository;
use App\Entity\PatronPrestataire;


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
     * @Route("/profile/edit_profile_ro/{id}", name="editRO")
     */
    public function EditRestaurantOwner(PatronRestaurantRepository $patronResto, Request $request, EntityManagerInterface $em, $id)
    {
        $infosAdmin = $patronResto->getAdminInfos($id);

        $em = $this->getDoctrine()->getManager();
        $restaurant_owner = $em->getRepository(PatronRestaurant::class)->find($id);
        $form = $this->createForm(RegistrationFormType::class, $restaurant_owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profileResto');

        }

        return $this->render('registration/patronRestaurant.html.twig', [
            'patronRestaurantForm'=> $form->createView(),
            'infosAdmin' => $infosAdmin,
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
     * @Route("/profile/edit_profile_so/{id}", name="editSO")
     */
    public function EditServiceOwner(PatronPrestataireRepository $patronPresta, Request $request, EntityManagerInterface $em, $id)
    {
        $infosAdmin = $patronPresta->getAdminInfos($id);

        $em = $this->getDoctrine()->getManager();
        $prestataire_owner = $em->getRepository(PatronPrestataire::class)->find($id);
        $form = $this->createForm(RegistrationFormType::class, $prestataire_owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profilePresta');

        }

        return $this->render('registration/patronPrestataire.html.twig', [
            'patronPrestataireForm'=> $form->createView(),
            'infosAdmin' => $infosAdmin,
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
