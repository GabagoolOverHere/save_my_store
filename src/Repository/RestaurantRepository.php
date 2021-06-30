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
            ->select('r.camis', '(q.nom) AS quartier', 'r.nom', 'r.immeuble', 'r.rue', 'r.code_postal', 'r.tel', 'r.latitude', 'r.longitude', 'tp.intitule')
            ->innerJoin('App\Entity\Quartier', 'q', Join::WITH, 'r.quartier = q.id')
            ->innerJoin('App\Entity\Probleme', 'p', Join::WITH, 'p.restaurant = r.id')
            ->innerJoin('App\Entity\TypeProbleme', 'tp', Join::WITH, 'p.typeProbleme = tp.id')
            ->where('r.camis > 0')
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
