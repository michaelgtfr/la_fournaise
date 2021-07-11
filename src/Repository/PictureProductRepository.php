<?php

namespace App\Repository;

use App\Entity\PictureProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureProduct[]    findAll()
 * @method PictureProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureProduct::class);
    }

    // /**
    //  * @return PictureProduct[] Returns an array of PictureProduct objects
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
    public function findOneBySomeField($value): ?PictureProduct
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
