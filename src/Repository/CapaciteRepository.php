<?php

namespace App\Repository;

use App\Entity\Capacite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Capacite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capacite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capacite[]    findAll()
 * @method Capacite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapaciteRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Capacite::class);
        $this->manager = $manager;
    }

    // /**
    //  * @return Capacite[] Returns an array of Capacite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Capacite
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save($newCapacite)
    {
        $this->manager->persist($newCapacite);
        $this->manager->flush();
    }
    public function update(Capacite $capacite): Capacite
    {
        $this->manager->persist($capacite);
        $this->manager->flush();
        return $capacite;
    }
    public function remove(Capacite $capacite)
    {
        $this->manager->remove($capacite);
        $this->manager->flush();
    }
}
