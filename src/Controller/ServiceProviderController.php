<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\PatronPrestataire;
use App\Form\ServiceProviderFormType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/* N'ENREGISTRE QUE LES PATRONS DE PRESTATAIRES */
class ServiceProviderController extends AbstractController
{
    #[Route('/registerSP', name: 'app_register_SP')]
    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, AdminRepository $adminRepository): Response
    {
        $user = new Admin;
        $service_provider = new PatronPrestataire();
        $form = $this->createForm(ServiceProviderFormType::class, $service_provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('username')->getData();
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
            
            //$user->setEstPatronRestaurant(false);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service_provider);
            $entityManager->flush();
            $user->setPatronPrestataire($service_provider);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
