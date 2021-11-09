<?php

namespace App\Repository;

use App\Entity\ResesrvationDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResesrvationDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResesrvationDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResesrvationDetail[]    findAll()
 * @method ResesrvationDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResesrvationDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResesrvationDetail::class);
    }

    // /**
    //  * @return ResesrvationDetail[] Returns an array of ResesrvationDetail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResesrvationDetail
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
