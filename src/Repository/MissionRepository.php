<?php

namespace App\Repository;

use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }

    public function getPrestaMissions($id){
        $query = $this->createQueryBuilder('m');

        return $query
            ->select('m.id', 'm.descriptif', 'm.date_debut', 'm.date_fin', 'm.date_facture', 'm.facture')
            ->join('App\Entity\Prestataire', 'p', Join::WITH, 'm.prestataire = p.id')
            ->where('p.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult()

            ;
    }

    public function getRestaurant($id){
        $query = $this->createQueryBuilder('m');

        return $query
            ->select('(r.nom) AS restaurant')
            ->join('App\Entity\Probleme', 'p', Join::WITH, 'p.mission = m.id')
            ->where('p.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult()

            ;
    }

// public function getPatron($id){
//         $query = $this->createQueryBuilder('m');
//         return $query
//             ->select('pp.id')
//             ->join('App\Entity\Prestataire', 'p', Join::WITH, 'm.prestataire_id = p.id')
//             ->innerJoin('App\Entity\PatronPrestataire', 'pp', Join::WITH, 'p.patronPrestataire = pp.id')
//             ->where('pp.id = :id')
//             ->setParameter(':id',$id)
//             ->getQuery()
//             ->getResult()
//             ;
//     }

    // /**
    //  * @return Mission[] Returns an array of Mission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mission
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
