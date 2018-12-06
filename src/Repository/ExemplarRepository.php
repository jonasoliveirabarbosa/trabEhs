<?php

namespace App\Repository;

use App\Entity\Exemplar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exemplar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exemplar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exemplar[]    findAll()
 * @method Exemplar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExemplarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exemplar::class);
    }

    // /**
    //  * @return Exemplar[] Returns an array of Exemplar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exemplar
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
