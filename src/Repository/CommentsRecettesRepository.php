<?php

namespace App\Repository;

use App\Entity\CommentsRecettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentsRecettes>
 *
 * @method CommentsRecettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentsRecettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentsRecettes[]    findAll()
 * @method CommentsRecettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsRecettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentsRecettes::class);
    }

//    /**
//     * @return CommentsRecettes[] Returns an array of CommentsRecettes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentsRecettes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
