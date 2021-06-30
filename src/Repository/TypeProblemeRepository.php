<?php

namespace App\Repository;

use App\Entity\TypeProbleme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Probleme;

/**
 * @method TypeProbleme|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeProbleme|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeProbleme[]    findAll()
 * @method TypeProbleme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProblemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeProbleme::class);
    }


    // /**
    //  * @return TypeProbleme[] Returns an array of TypeProbleme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeProbleme
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
