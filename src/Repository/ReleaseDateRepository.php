<?php

namespace App\Repository;

use App\Entity\ReleaseDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReleaseDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReleaseDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReleaseDate[]    findAll()
 * @method ReleaseDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReleaseDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReleaseDate::class);
    }

    // /**
    //  * @return ReleaseDate[] Returns an array of ReleaseDate objects
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
    public function findOneBySomeField($value): ?ReleaseDate
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
