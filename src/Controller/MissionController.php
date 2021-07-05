<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\PatronPrestataire;
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

    public function index(): Response
    {
        return $this->render('mission/index.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }

    /**
     * @Route("/newmission/{id}", name="newmission")
     */
    public function register(Request $request, EntityManagerInterface $em, $id, AdminRepository $adminRepository, PatronPrestataireRepository $service_provider): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $service_provider = $em->getRepository(PatronPrestataire::class)->find($id);
        $mission = new Mission();
        $form = $this->createForm(MissionFormType::class, $mission);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $prestataire = $form->get('prestataire')->getData('id');
            $mission->setPrestataire($prestataire);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('profileService');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
