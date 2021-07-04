<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\PatronPrestataire;
use App\Entity\Prestataire;
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
        $enterprise = new Prestataire;
        $form = $this->createForm(ServiceProviderFormType::class, $service_provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Creation de l'entité Admin (user)
            $username = $form->get('username')->getData();
            $count = $adminRepository->findBy(['username' => $username]);
            if ($count) {
                $this->addFlash('error', 'Username already used, please make another choice.');
                return $this->redirectToRoute('app_register_SP');
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

            // Creation de l'entité prestataire
            $share_info=$form->get('share_info')->getData();
            $enterprise->setNom($form->get('nom_societe')->getData());
            $enterprise->setQuartier($form->get('quartier_societe')->getData('id'));
            $enterprise->setTarif($form->get('tarif_societe')->getData());
            if ($share_info) {
                $enterprise->setEmail($form->get('email')->getData());
                $enterprise->setTel($form->get('tel')->getData());
                $enterprise->setRue($form->get('rue')->getData());
                $enterprise->setImmeuble($form->get('immeuble')->getData());
                $enterprise->setCodePostal($form->get('code_postal')->getData());
            } else {
                $enterprise->setEmail($form->get('email_societe')->getData());
                $enterprise->setTel($form->get('tel_societe')->getData());
                $enterprise->setRue($form->get('rue_societe')->getData());
                $enterprise->setImmeuble($form->get('immeuble_societe')->getData());
                $enterprise->setCodePostal($form->get('code_postal_societe')->getData());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service_provider);
            $entityManager->flush();
            $enterprise->setPatronPrestataire($service_provider);
            $entityManager->persist($enterprise);
            $entityManager->flush();
            $user->setPatronPrestataire($service_provider);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/patronPrestataire.html.twig', [
            'patronPrestataireForm' => $form->createView(),
        ]);
    }
}
