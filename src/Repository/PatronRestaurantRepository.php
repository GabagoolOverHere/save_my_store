<?php

namespace App\Repository;

use App\Entity\PatronRestaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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

    public function getPatronInfos(int $id)
    {
        $query = $this->createQueryBuilder('pr');

        return $query
            ->select('pr.nom', 'pr.prenom', 'pr.code_postal', 'pr.email', 'pr.immeuble', 'pr.rue', 'pr.tel')
            ->where('pr.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
    }

    public function getRestaurantsInfos(int $id)
    {
        $query = $this->createQueryBuilder('pr');

        return $query
            ->select('r.camis', '(r.id) AS id_resto', '(r.nom) AS nom_resto', '(r.immeuble) AS immeuble_resto',
                '(r.rue) AS rue_resto', '(r.code_postal) AS code_postal_resto')
            ->Join('App\Entity\Restaurant', 'r', Join::WITH, 'r.patronRestaurant = pr.id')
            ->where('pr.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
    }

    public function getAdminInfos(int $id)
    {
        $query = $this->createQueryBuilder('pr');

        return $query
            ->select('a.id', 'a.username')
            ->Join('App\Entity\Admin', 'a', Join::WITH, 'a.patron_restaurant = pr.id')
            ->where('pr.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
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
