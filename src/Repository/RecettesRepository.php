<?php

namespace App\Repository;

use App\Entity\Recettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @extends ServiceEntityRepository<Recettes>
 *
 * @method Recettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recettes[]    findAll()
 * @method Recettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recettes::class);
    }


    
    #public function __toString(): string
    #{
        
   # }
//    /**
//     * @return Recettes[] Returns an array of Recettes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recettes
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function  findRecettes( $allergeneId = null)
    {

        $queryBuilder = $this->createQueryBuilder('r')
                        ->leftjoin( 'r.allergenes', 'a');

            if ( $allergeneId !== null) {

                $queryBuilder->where('a.id = :allergeneId')
                    ->setParameter('allergeneId', $allergeneId);
             
    }

            return $queryBuilder->getQuery()->getResult();
  }

  public function  findRecette( $regimesId = null)
  {

      $queryBuilder = $this->createQueryBuilder('r')
                      ->leftjoin( 'r.regimes', 'r');

          if ( $regimesId !== null) {

              $queryBuilder->where('r.id = :regimesId')
                  ->setParameter('regimesId', $regimesId);
           
  }

          return $queryBuilder->getQuery()->getResult();
}

  


}
