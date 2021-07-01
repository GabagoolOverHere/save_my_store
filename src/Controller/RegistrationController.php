<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Restaurant;
use App\Entity\PatronRestaurant;
use App\Form\RegistrationFormType;
use App\Repository\AdminRepository;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
}
