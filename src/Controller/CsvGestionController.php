<?php
namespace App\Controller;

ini_set('max_execution_time', 0); // changer le temps dispo pour charger la page, infinie soit fin de l'exécution du script


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuartierRepository;
use App\Repository\TypeProblemeRepository;
use App\Repository\RestaurantRepository;
use App\Repository\ProblemeRepository;
use App\Entity\Quartier;
use App\Entity\TypeProbleme;
use App\Entity\Restaurant;
use App\Entity\Probleme;

class CsvGestionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/csv", name="Csv")
     */
    public function index(QuartierRepository $quartier, TypeProblemeRepository $typeProbleme, RestaurantRepository $restaurant, ProblemeRepository $probleme): Response
    {
        $url ='https://data.cityofnewyork.us/api/views/43nn-pn8j/rows.csv?accessType=DOWNLOAD&#039;';

        $handle = fopen($url, 'r');
        $i=0;

        while (($line=fgetcsv($handle, 0, ',')) && $i<5000) {
            $data = $quartier->findOneBy(['nom' => $line[2]]);
            if (is_null($data)) {
                $data = new Quartier();
                $data->setNom($line[2]);
                $this->entityManager->persist($data);
                $this->entityManager->flush();
            }

            $tPbl = $typeProbleme->findOneBy(['violation_code' => $line[10]]);
            if (is_null($tPbl)) {
                $tPbl = new TypeProbleme();
                $tPbl ->setIntitule($line[11]);
                $tPbl ->setViolationCode($line[10]);
                $this->entityManager->persist($tPbl);
                $this->entityManager->flush();
            }

            $resto = $restaurant->findOneBy(['camis' => $line[0]]);
            if (is_null($resto)) {
                $resto = new Restaurant();
                $resto ->setCamis((int)$line[0]); //(int) pour forcer le transtipage
                $resto ->setNom($line[1]);
                $resto ->setImmeuble($line[3]);
                $resto ->setRue($line[4]);
                $resto ->setCodePostal((int)$line[5]);
                $resto ->setTel((int)$line[6]);
                $resto ->setLatitude((float)$line[18]);
                $resto ->setLongitude((float)$line[19]);
                $resto ->setQuartier($data);
                $this->entityManager->persist($resto);
                $this->entityManager->flush();
            }

            $pbl = $probleme->findOneBy(['typeProbleme' => $tPbl, 'restaurant' => $resto]);
            if (is_null($pbl)) {
                $pbl = new Probleme();
                $pbl->setTypeProbleme($tPbl);
                $pbl->setRestaurant($resto);
                $this->entityManager->persist($pbl);
                $this->entityManager->flush();
            }
            $i++;
        }
    }
}
