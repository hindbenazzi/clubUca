<?php

namespace App\Repository;

use App\Entity\TypeLocal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @method TypeLocal|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLocal|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLocal[]    findAll()
 * @method TypeLocal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLocalRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, TypeLocal::class);
        $this->manager = $manager;
    }

    // /**
    //  * @return TypeLocal[] Returns an array of TypeLocal objects
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
    public function findOneBySomeField($value): ?TypeLocal
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function save($newType)
    {
        $this->manager->persist($newType);
        $this->manager->flush();
    }
     public function update(TypeLocal $type): TypeLocal
    {
           $this->manager->persist($type);
           $this->manager->flush();
           return $type;
    } 
    public function remove(TypeLocal $type)
    {
            $this->manager->remove($type);
            $this->manager->flush();
    }
}
