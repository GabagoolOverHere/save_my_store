<?php

namespace App\Controller;
use App\Entity\Mission;
use App\Form\MissionFormType;
use App\Repository\AdminRepository;
use App\Repository\PatronPrestataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    #[Route('/mission', name: 'mission')]
    public function index(): Response
    {
        return $this->render('mission/index.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }

    #[Route('/newmission', name: 'New Mission')]
    public function register(Request $request, EntityManagerInterface $em, AdminRepository $adminRepository, PatronPrestataireRepository $patronPrestataireRepository): Response
    {
        $patronPrestataire = $adminRepository->get('patron_prestataire_id')->getData();
        $prestataire=$patronPrestataireRepository->get('prestataire_id')->getData();
        $mission = New Mission;
        $form = $this->createForm(MissionFormType::class, $mission);
        $form->$form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $description = $form->get('description')->getData();
            $mission->setDescriptif($description);
            $dateDebut = $form->get('date_debut')->getData();
            $mission->setDateDebut($dateDebut);
            $dateFin = $form->get('date_fin')->getData();
            $mission->setDateFin($dateFin);
            $dateFacture = $form->get('date_facture')->getData();
            $mission->setDateFacture($dateFacture);
            $montant = $form->get('montant')->getData();
            $mission->setMontant($montant);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($patronPrestataire);
            $em->flush();
            $mission->setPrestataire($prestataire);

            return $this->redirectToRoute('profile');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
