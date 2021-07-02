<?php

namespace App\Repository;

use App\Entity\PatronPrestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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

    public function getPatronInfos(int $id){
        $query = $this->createQueryBuilder('pp');

        return $query
            ->select('pp.nom', 'pp.prenom', 'pp.code_postal', 'pp.email', 'pp.immeuble', 'pp.rue', 'pp.tel')
            ->where('pp.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult()

            ;
    }

    public function getPrestatairesInfos(int $id){
        $query = $this->createQueryBuilder('pp');

        return $query
            ->select('(p.id) AS id_presta', '(p.nom) AS nom_presta', '(p.immeuble) AS immeuble_presta', '(p.rue) AS rue_presta', '(p.code_postal) AS code_postal_presta')
            ->Join('App\Entity\Prestataire', 'p', Join::WITH, 'p.patronPrestataire = pp.id')
            ->where('pp.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult()

            ;
    }

    public function getAdminInfos(int $id)
    {
        $query = $this->createQueryBuilder('pp');

        return $query
            ->select('a.id', 'a.username')
            ->Join('App\Entity\Admin', 'a', Join::WITH, 'a.patron_restaurant = pp.id')
            ->where('pp.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
    }

    public function getPatronMissions(int $id){
        $query = $this->createQueryBuilder('pp');

        return $query
            ->select('m.id', 'm.descriptif')
            ->Join('App\Entity\Prestataire', 'p', Join::WITH, 'p.patronPrestataire = pp.id')
            ->innerJoin('App\Entity\Mission', 'm', Join::WITH, 'm.prestataire = p.id')
            ->where('pp.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
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
