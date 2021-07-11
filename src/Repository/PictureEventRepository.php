<?php

namespace App\Repository;

use App\Entity\PictureEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureEvent[]    findAll()
 * @method PictureEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureEvent::class);
    }

    // /**
    //  * @return PictureEvent[] Returns an array of PictureEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PictureEvent
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
