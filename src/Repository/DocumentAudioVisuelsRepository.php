<?php

namespace App\Repository;

use App\Entity\DocumentAudioVisuels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DocumentAudioVisuels|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentAudioVisuels|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentAudioVisuels[]    findAll()
 * @method DocumentAudioVisuels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentAudioVisuelsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DocumentAudioVisuels::class);
    }

    // /**
    //  * @return DocumentAudioVisuels[] Returns an array of DocumentAudioVisuels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocumentAudioVisuels
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
