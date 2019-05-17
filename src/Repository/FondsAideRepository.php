<?php

namespace App\Repository;

use App\Entity\FondsAide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FondsAide|null find($id, $lockMode = null, $lockVersion = null)
 * @method FondsAide|null findOneBy(array $criteria, array $orderBy = null)
 * @method FondsAide[]    findAll()
 * @method FondsAide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FondsAideRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FondsAide::class);
    }

    // /**
    //  * @return FondsAide[] Returns an array of FondsAide objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FondsAide
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
