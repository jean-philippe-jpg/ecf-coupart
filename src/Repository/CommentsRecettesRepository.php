<?php

namespace App\Repository;

use App\Entity\CommentsRecettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Float_;

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
    public function getMoyenneNotes($recetteId): float|null
   {
    return $this->createQueryBuilder('r')

            ->select('AVG(r.note) as moyenneNotes')
            ->where('r.recettes = :recetteId')
            ->setParameter('recetteId', $recetteId)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

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
