<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Restaurant;
use App\Entity\PatronRestaurant;
use App\Entity\PatronPrestataire;
use App\Form\RegistrationFormType;
use App\Form\EditPatronFormType;
use App\Form\EditProfileFormType;
use App\Form\LinkRestaurantToOwnerFormType;
use App\Repository\AdminRepository;
use App\Repository\PatronRestaurantRepository;
use App\Repository\PatronPrestataireRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormTypeInterface;

/* N'ENREGISTRE QUE LES PATRONS DE RESTAURANT */
class RegistrationController extends AbstractController
{
    #[Route('/registerRO', name: 'app_register_RO')]
    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, AdminRepository $adminRepository): Response
    {
        $user = new Admin;
        $restaurant_owner = new PatronRestaurant();
        $form = $this->createForm(RegistrationFormType::class, $restaurant_owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('username')->getData();
            $restaurant_id = $form->get('Restaurant')->getData('ID');
            $count = $adminRepository->findBy(['username' => $username]);
            if ($count) {
                $this->addFlash('error', 'Username already used, please make another choice.');
                return $this->redirectToRoute('home');
            }
            $user->setUsername($username);
            $user->setRoles(["ROLE_USER"]);
            $user->setEmail($form->get('email')->getData());
            //encode the plain password
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurant_owner);
            $entityManager->flush();
            $restaurant_owner->addRestaurant($restaurant_id);
            $user->setPatronRestaurant($restaurant_owner);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/patronRestaurant.html.twig', [
            'patronRestaurantForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/edit_profile_ro/{id}", name="editRO")
     */
    public function EditRestaurantOwner(Request $request, EntityManagerInterface $em,int $id, PatronRestaurantRepository $restaurant_owner, AdminRepository $adminRepository)
    {
        $em = $this->getDoctrine()->getManager();
        // $infosAdmin = $em->getRepository(Admin::class)->find($id);
        // $formProfile = $this->createForm(EditProfileFormType::class, $infosAdmin);

        $restaurant_owner = $em->getRepository(PatronPrestataire::class)->find($id);
        $formPatron = $this->createForm(EditPatronFormType::class, $restaurant_owner);
        $formRestaurant = $this->createForm(LinkRestaurantToOwnerFormType::class, $restaurant_owner);
        
        // $formProfile->handleRequest($request);
        $formPatron->handleRequest($request);
        $formRestaurant->handleRequest($request);

        // if ($formProfile->isSubmitted() && $formProfile->isValid()) {
        //     $username = $em->getRepository(PatronRestaurant::class)->find($id);
        //     $count = $adminRepository->findBy(['username' => $username]);
        //     if ($count) {
        //         $this->addFlash('error', 'Username already used, please make another choice.');
        //     }
        //     $em->persist($infosAdmin);
        //     $em->flush();

        //     return $this->redirect('/profile/restaurant_owner/' . $id);
        // }

        if ($formPatron->isSubmitted() && $formPatron->isValid()) {
            $em->persist($restaurant_owner);
            $em->flush();

            return $this->redirect('/profile/restaurant_owner/' . $id);
        }

        if ($formRestaurant->isSubmitted() && $formRestaurant->isValid()) {
            $restaurant_id = $formRestaurant->get('Restaurant')->getData();
            $restaurant_owner->addRestaurant($restaurant_id);
            $em->persist($restaurant_owner);
            $em->flush();

            return $this->redirect('/profile/restaurant_owner/' . $id);
        }

        return $this->render('registration/editPatronRestaurant.html.twig', [
        // 'infosAdmin'=> $infosAdmin,
        'editPatronRestaurantForm'=> $formPatron->createView(),
        // 'infosAdmin'=> $formProfile->createView(),
        'addRestaurantToOwnerForm' => $formRestaurant->createView(),
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
        $formSociety = $this->createForm(AddServiceSociety::class, $service_owner);
        
        // $formProfile->handleRequest($request);
        $formPatron->handleRequest($request);
        $formSociety->handleRequest($request);

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
        if ($formSociety->isSubmitted() && $formSociety->isValid()){
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
}