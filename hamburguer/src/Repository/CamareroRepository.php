<?php

namespace App\Repository;

use App\Entity\Camarero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Camarero|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camarero|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camarero[]    findAll()
 * @method Camarero[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamareroRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Camarero::class);
    }

//    /**
//     * @return Camarero[] Returns an array of Camarero objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Camarero
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
