<?php

namespace App\Repository;

use App\Entity\PlanPricing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanPricing|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanPricing|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanPricing[]    findAll()
 * @method PlanPricing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanPricingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanPricing::class);
    }

    // /**
    //  * @return PlanPricing[] Returns an array of PlanPricing objects
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
    public function findOneBySomeField($value): ?PlanPricing
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
