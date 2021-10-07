<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Utilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateurs[]    findAll()
 * @method Utilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateurs::class);
    }

    // /**
    //  * @return Utilisateurs[] Returns an array of Utilisateurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findApiByUsers()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

    public function findUser($mail, $pass)
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQueryBuilder();
        $query->select('u.token, u.mail')
        ->from('App\Entity\Utilisateurs', 'u')
        ->where('u.mail = :mail')
        ->andWhere('u.password = :pass')
        ->setMaxResults(1)
        ->setParameter('mail', $mail)
        ->setParameter('pass', $pass);

        return $query->getQuery()->getResult();   

    }

    public function findCookie($token, $mail)
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQueryBuilder();
        $query->select('u.token, u.mail')
        ->from('App\Entity\Utilisateurs', 'u')
        ->where('u.token = :token')
        ->andWhere('u.mail = :mail')
        ->setMaxResults(1)
        ->setParameter('token', $token)
        ->setParameter('mail', $mail);

        return $query->getQuery()->getResult();   

    }

        // return $this->createQueryBuilder('d')
        // ->SELECT token
        // ->FROM d.utilisateur
        // ->WHERE d.mail = :mail AND d.password = :password
        // ->setParameter('mail', $mail)
        // ->setParameter('pass', $pass)
        // ->getResult();
       
    

    /*
    public function findOneBySomeField($value): ?Utilisateurs
    {

        select token from utilisateurs where mail="amin@mira.com" AND password="123456";

        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
