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
     * @Route("/newmission/{camis}/{id}", name="newmission")
     */
    public function register(Request $request, EntityManagerInterface $em, $id, PatronPrestataireRepository $service_provider): Response
    {
        $mission = new Mission;
        $service_provider = $em->getRepository(PatronPrestataire::class)->find($id);
        $form = $this->createForm(MissionFormType::class, $service_provider);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $prestataire = $form->get('prestataire')->getData();
            $mission->setPrestataire($prestataire);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('profileService');
        }

        return $this->render('registration/addMission.html.twig', [
            'addMission' => $form->createView(),
        ]);
    }
}
