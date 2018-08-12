<?php

namespace App\Repository;

use App\Entity\Comanda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comanda|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comanda|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comanda[]    findAll()
 * @method Comanda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComandaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comanda::class);
    }

    /**
     * @param $estado
     * @return array
     * @return Comanda[] Returns an array of Comanda objects
     */
    public function findByEstado($estado)
    {

        $qb = $this->createQueryBuilder('p')
        ->andWhere('p.estado = :estado')
        ->setParameter('estado', $estado)
        ->orderBy('p.mesa', 'ASC')
        ->getQuery();
        return $qb->execute();

    }


//    /**
//     * @return Comanda[] Returns an array of Comanda objects
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
    public function findOneBySomeField($value): ?Comanda
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
