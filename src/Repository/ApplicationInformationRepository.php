<?php

namespace App\Repository;

use App\Entity\ApplicationInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApplicationInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationInformation[]    findAll()
 * @method ApplicationInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationInformation::class);
    }

    // /**
    //  * @return ApplicationInformation[] Returns an array of ApplicationInformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApplicationInformation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
