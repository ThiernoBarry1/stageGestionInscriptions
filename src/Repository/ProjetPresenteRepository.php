<?php

namespace App\Repository;

use App\Entity\ProjetPresente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetPresente|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetPresente|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetPresente[]    findAll()
 * @method ProjetPresente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetPresenteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetPresente::class);
    }

    // /**
    //  * @return ProjetPresente[] Returns an array of ProjetPresente objects
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
    public function findOneBySomeField($value): ?ProjetPresente
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
