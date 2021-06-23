<?php

namespace App\Repository;

use App\Entity\PatronRestaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatronRestaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatronRestaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatronRestaurant[]    findAll()
 * @method PatronRestaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatronRestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatronRestaurant::class);
    }

    // /**
    //  * @return PatronRestaurant[] Returns an array of PatronRestaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PatronRestaurant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
