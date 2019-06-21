<?php

namespace App\Repository;

use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Projet::class);
    }
    
    public function findOneByCriteres($mail,$token,$token_date)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.mailUtilisateur = :mail')
            ->setParameter('mail', $mail)
            ->andWhere('p.motpassehass = :token')
            ->setParameter('token', $token)
            ->andWhere('p.token_date = :token_date')
            ->setParameter('token_date', $token_date)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findOneByMailToken($mail,$token)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.mailUtilisateur = :mail')
            ->setParameter('mail', $mail)
            ->andWhere('p.motpassehass = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }







    // /**
    //  * @return Projet[] Returns an array of Projet objects
    //  */
    /*findOneByCriteres
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
    public function findOneBySomeField($value): ?Projet
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
