<?php

namespace App\Repository;

use App\Entity\PatronPrestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatronPrestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatronPrestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatronPrestataire[]    findAll()
 * @method PatronPrestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatronPrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatronPrestataire::class);
    }

    // /**
    //  * @return PatronPrestataire[] Returns an array of PatronPrestataire objects
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
    public function findOneBySomeField($value): ?PatronPrestataire
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
