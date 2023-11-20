<?php

namespace App\Repository;

use App\Entity\Xproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Xproduct>
 *
 * @method Xproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Xproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Xproduct[]    findAll()
 * @method Xproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Xproduct::class);
    }

//    /**
//     * @return Xproduct[] Returns an array of Xproduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('x')
//            ->andWhere('x.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('x.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Xproduct
//    {
//        return $this->createQueryBuilder('x')
//            ->andWhere('x.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
