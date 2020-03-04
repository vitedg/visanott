<?php

namespace App\Repository;

use App\Entity\TypeAnomalies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeAnomalies|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAnomalies|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAnomalies[]    findAll()
 * @method TypeAnomalies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAnomaliesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAnomalies::class);
    }

    // /**
    //  * @return TypeAnomalies[] Returns an array of TypeAnomalies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeAnomalies
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
