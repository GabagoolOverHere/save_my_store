<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function getRestaurantsAndProblems(){
        $query = $this->createQueryBuilder('r');

        return $query
            ->select('r.camis', '(q.nom) AS quartier', 'r.nom', 'r.immeuble', 'r.rue', 'r.tel', 'r.latitude', 'r.longitude', 'tp.intitule', '(tp.violation_code) AS violation')
            ->join('App\Entity\Quartier', 'q', Join::WITH, 'r.quartier = q.id')
            ->innerJoin('App\Entity\Probleme', 'p', Join::WITH, 'p.restaurant = r.id')
            ->innerJoin('App\Entity\TypeProbleme', 'tp', Join::WITH, 'p.typeProbleme = tp.id')
            ->where('r.camis > 0')
            ->andWhere($query->expr()->orX(
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04M')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04L')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('08A')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04N')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10F')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('08C')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10B')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('20D')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05H')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05E')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05D')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10C')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04J')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04J')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10A')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10E')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10D')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05F')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05C')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05A')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('05B')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('04O')),
                $query->expr()->like('tp.violation_code', $query->expr()->literal('10H'))
            ))
            ->getQuery()
            ->getResult()

            ;
    }

    public function getRestoMissions($id){
        $query = $this->createQueryBuilder('r');

        return $query
            ->select('m.id', 'm.descriptif', 'm.date_debut', 'm.date_fin', 'm.date_facture', 'm.facture', 'r.nom')
            ->join('App\Entity\Probleme', 'p', Join::WITH, 'p.restaurant = r.id')
            ->innerJoin('App\Entity\Mission', 'm', Join::WITH, 'p.mission = m.id')
            ->where('r.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult()

            ;
    }


    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Restaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
