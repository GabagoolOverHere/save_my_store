<?php

namespace App\Controller;

use App\Entity\PatronRestaurant;
use App\Form\AccountType;
use App\Form\AddSocietyFormType;
use App\Form\EditAccountType;
use App\Form\EditPatronFormType;
use App\Form\EditProfileFormType;
use App\Form\RegistrationFormType;
use App\Repository\AdminRepository;
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
use App\Entity\Admin;


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
        $allMissions = $patronService->getPatronMissions($id);

        return $this->render('profile/service.html.twig', [
            'infosPatron' => $infosPatron,
            'infosPrestataires' => $infosPrestataires,
            'missions'=>$allMissions,
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

    /**
     * @Route("/profile/edit_profile_so/{id}", name="editSO")
     */
    public function EditServiceOwner(Request $request, EntityManagerInterface $em,int $id, PatronPrestataireRepository $service_owner, AdminRepository $adminRepository)
    {
        $em = $this->getDoctrine()->getManager();
        // $infosAdmin = $this->getUser('id');
        // $formProfile = $this->createForm(EditProfileFormType::class, $infosAdmin);

        $service_owner = $em->getRepository(PatronPrestataire::class)->find($id);
        $formPatron = $this->createForm(EditPatronFormType::class, $service_owner);

        // $formProfile->handleRequest($request);
        $formPatron->handleRequest($request);

        // if ($formProfile->isSubmitted() && $formProfile->isValid()){
        //     $username = $em->getRepository(PatronPrestataire::class)->find($infosAdmin);
        //     $count = $adminRepository->findBy(['username' => $username]);
        //     if ($count) {
        //         $this->addFlash('error', 'Username already used, please make another choice.');
        //     }
        //     $em->persist($infosAdmin);
        //     $em->flush();

        //     return $this->redirect('/profile/service_owner/' . $id);

        // }

        if ($formPatron->isSubmitted() && $formPatron->isValid()){
            $em->persist($service_owner);
            $em->flush();

            return $this->redirect('/profile/service_owner/' . $id);

        }


        return $this->render('registration/editPatronPrestataire.html.twig', [
            // 'infosAdmin'=> $infosAdmin,
            'editPatronPrestataireForm'=> $formPatron->createView(),
            // 'infosAdmin'=> $formProfile->createView(),

        ]);
    }

    /**
     * @Route("/profile/edit_account_so/{id}", name="accountSO")
     */
    public function AccountServiceOwner(Request $request, EntityManagerInterface $em,int $id, PatronPrestataireRepository $service_owner, AdminRepository $adminRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $service_owner = $em->getRepository(Admin::class)->findPatronPrestaAdmin($id);
        $formAccount = $this->createForm(EditAccountType::class, $service_owner);

        $formAccount->handleRequest($request);


        if ($formAccount->isSubmitted() && $formAccount->isValid()){
            $em->persist($service_owner);
            $em->flush();

            return $this->redirect('/profile/service_owner/' . $id);

        }

        return $this->render('registration/editAccount.html.twig', [
            'editAccount'=> $formAccount->createView(),

        ]);
    }
}
