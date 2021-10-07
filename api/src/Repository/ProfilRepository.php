<?php

namespace App\Repository;

use App\Entity\Profil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Profil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profil[]    findAll()
 * @method Profil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profil::class);
    }

    // /**
    //  * @return Profil[] Returns an array of Profil objects
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
    public function findApiByProfil($immatriculation)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.immatriculation = :val')
            ->setParameter('val', $immatriculation)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

     public function findByProfil($immatriculation)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.immatriculation = :val')
            ->setParameter('val', $immatriculation)
            ->getQuery()
            ->getResult()
        ;
    }

     public function findApiAll()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.invite = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }



        
    /*
    public function findOneBySomeField($value): ?Profil
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    INSERT INTO `profil` (`id`, `utilisateurs_id`, `immatriculation`, `nom`, `prenom`, `url_photo`, `invite`) VALUES
    (3, 1, 'BB-123-BB', 'VIBERT', 'Greg', '1-SQDFQSDF', 0);
    */
}
