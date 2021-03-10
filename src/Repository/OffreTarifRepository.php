<?php

namespace App\Repository;

use App\Entity\OffreTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreTarif[]    findAll()
 * @method OffreTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreTarif::class);
    }

    // /**
    //  * @return OffreTarif[] Returns an array of OffreTarif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreTarif
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
