<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Restaurant;
use App\Entity\PatronRestaurant;
use App\Entity\PatronPrestataire;
use App\Entity\Prestataire;
use App\Form\AddSocietyFormType;
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

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/patronRestaurant.html.twig', [
            'patronRestaurantForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/edit_profile_ro/{id}", name="editRO")
     */
    public function EditRestaurantOwner(Request $request, EntityManagerInterface $em,int $id, PatronRestaurantRepository $restaurant_owner)
    {
        $em = $this->getDoctrine()->getManager();

        $restaurant_owner = $em->getRepository(PatronRestaurant::class)->find($id);
        $formPatron = $this->createForm(EditPatronFormType::class, $restaurant_owner);
        
        $formPatron->handleRequest($request);

        if ($formPatron->isSubmitted() && $formPatron->isValid()) {
            $em->persist($restaurant_owner);
            $em->flush();

            return $this->redirect('/profile/restaurant_owner/' . $id);
        }

        return $this->render('registration/editPatronRestaurant.html.twig', [
        'editPatronRestaurantForm'=> $formPatron->createView(),
        ]);
    }
     
    
    /**
     * @Route("/profile/add_restaurant_ro/{id}", name="addRO")
     */
    public function AddRestaurantToOwner(Request $request, EntityManagerInterface $em,int $id, PatronRestaurantRepository $restaurant_owner)
    {   
        $em = $this->getDoctrine()->getManager();
        $restaurant_owner = $em->getRepository(PatronRestaurant::class)->find($id);
        $formRestaurant = $this->createForm(LinkRestaurantToOwnerFormType::class, $restaurant_owner);

        $formRestaurant->handleRequest($request);

        if ($formRestaurant->isSubmitted() && $formRestaurant->isValid()) {
            $restaurant_id = $formRestaurant->get('Restaurant')->getData('ID');
            $restaurant_owner->addRestaurant($restaurant_id);
            $em->persist($restaurant_owner);
            $em->flush();

            return $this->redirect('/profile/restaurant_owner/' . $id);
        }

        return $this->render('registration/addRestaurantToOwner.html.twig', [
        'addRestaurantToOwnerForm' => $formRestaurant->createView(),
        ]);
    }

    /**
     * @Route("/profile/add_society/{id}", name="addSociety")
     */
        public function AddSocietyFormType(Request $request, EntityManagerInterface $em,int $id, PatronPrestataireRepository $service_owner)
    {
        $service_owner =$em->getRepository(PatronPrestataire::class)->find($id);
        $enterprise = new Prestataire();
        $formSociety = $this->createForm(AddSocietyFormType::class, $service_owner);
        $em = $this->getDoctrine()->getManager();

        $formSociety->handleRequest($request);

        if ($formSociety->isSubmitted() && $formSociety->isValid()){
            $enterprise->setNom($formSociety->get('nom_societe')->getData());
            $enterprise->setQuartier($formSociety->get('quartier_societe')->getData('id'));
            $enterprise->setTarif($formSociety->get('tarif_societe')->getData());
            $enterprise->setEmail($formSociety->get('email_societe')->getData());
            $enterprise->setTel($formSociety->get('tel_societe')->getData());
            $enterprise->setRue($formSociety->get('rue_societe')->getData());
            $enterprise->setImmeuble($formSociety->get('immeuble_societe')->getData());
            $enterprise->setCodePostal($formSociety->get('code_postal_societe')->getData());
            
            $em->persist($service_owner);
            $enterprise->setPatronPrestataire($service_owner);
            $em->flush();
            $em->persist($enterprise);
            $em->flush();
            return $this->redirect('/profile/service_owner/' . $id);
            
        }


        return $this->render('registration/addServiceSociety.html.twig', [
        'addPrestataireForm'=> $formSociety->createView(),
        ]);
    }
}