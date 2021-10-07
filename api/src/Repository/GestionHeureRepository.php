<?php

namespace App\Repository;

use App\Entity\GestionHeure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method GestionHeure|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionHeure|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionHeure[]    findAll()
 * @method GestionHeure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionHeureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionHeure::class);
    }

    // /**
    //  * @return GestionHeure[] Returns an array of GestionHeure objects
    //  */
    
    public function findApiByID($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

     public function findApiByLast($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->setMaxResults(1)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

    public function findApiAll()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

     public function findByGestion($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    
    

    /*
    public function findOneBySomeField($value): ?GestionHeure
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
