<?php

namespace App\Repository;

use App\Entity\NoteRecettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NoteRecettes>
 *
 * @method NoteRecettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteRecettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteRecettes[]    findAll()
 * @method NoteRecettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRecettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteRecettes::class);
    }

//    /**
//     * @return NoteRecettes[] Returns an array of NoteRecettes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NoteRecettes
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
